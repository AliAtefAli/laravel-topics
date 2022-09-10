<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait HasResponse
{
    public function failReturn($msg = '', $code = 401, $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'value' => '0',
            'key' => 'fail',
            'status' => false,
            'msg' => $msg,
            'code' => $code,
            'data' => $data,
        ]);
    }

    public function failMsg($msg = '', $code = 401): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'value' => '0',
            'key' => 'fail',
            'status' => false,
            'msg' => $msg,
            'code' => $code,
        ]);
    }

    public function successReturn($msg = '', $data = [], $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'value' => '1',
            'msg' => $msg,
            'key' => 'success',
            'code' => $code,
            'data' => $data
        ]);
    }

    public function successMsg($msg = '', $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'value' => '1',
            'msg' => $msg,
            'key' => 'success',
            'code' => $code,
        ]);
    }

    public function dataReturn($data, $key = 200, $msg = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            'key' => $key,
            'data' => $data,
        ]);
    }

    public function requestFailsReturn($validator, $type = 'all_in_string'): \Illuminate\Http\JsonResponse
    {
        switch ($type) {
            case 'all_in_string':
                $errors = $validator->errors()->all();
                $msg = implode(',', $validator->errors()->all());
                break;
            case 'first':
                $msg = $validator->errors()->first();
                break;
            case 'all_in_array':
                $msg = $validator->errors()->all();
                break;
            default:
                $msg = 'حدث خطأ ما';
        }

        return $this->failMsg($msg, 401);
    }

    public function validationResponse($validator, $type = 'first')
    {
        $msg = match ($type) {
            'all_in_string' => implode(',', $validator->errors()->all()),
            'first' => $validator->errors()->first(),
            'all_in_array' => $validator->errors()->all(),
            default => 'حدث خطأ ما',
        };

        throw new HttpResponseException($this->failMsg($msg, 401));
    }

    public function paginate($collection): array
    {
        return [
            'total' => $collection->total() ?? '',
            'count' => $collection->count() ?? '',
            'per_page' => $collection->perPage() ?? '',
            'current_page' => $collection->currentPage() ?? '',
            'last_page' => $collection->lastPage() ?? '',
        ];
    }
}
