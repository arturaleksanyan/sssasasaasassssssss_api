<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

use App\Models\Test;

use App\Helpers\QueryUtility;

use App\Helpers\ResponseHelper;

class TestController extends Controller
{
    public function getter(Request $request)
    {
        $data = QueryUtility::performQuery(Test::query(), $request, function ($options) {
            return $options;
        });

        return ResponseHelper::success($data, 200);
    }

    public function get(Request $request)
    {
        try {
            $data = Test::all();

            return ResponseHelper::success($data, 200);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $data = Test::create($request->all());

            return ResponseHelper::success($data, 200);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Test::find($id);

            if (!$data) {
                return ResponseHelper::error("Test not found", 404);
            }

            $data->update($request->all());

            return ResponseHelper::success("Updated", 200);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    public function remove($id)
    {
        try {
            $data = Test::find($id);

            if (!$data) {
                return ResponseHelper::error("Test not found", 404);
            }

            $data->delete();

            return ResponseHelper::success("Deleted", 200);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }

    public function removeMany(Request $request)
    {
        try {
            $ids = $request->input("ids");

            $deletedCount = Test::whereIn("id", $ids)->delete();

            if ($deletedCount > 0) {
                return ResponseHelper::success("Deleted", 200);
            } else {
                return ResponseHelper::error("No records found for deletion", 404);
            }
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage(), 500);
        }
    }
}
