
        <?php
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\NewtestController;
        use App\Http\Controllers\TestController;

        Route::prefix("newtest")->group(function () {
            Route::get("getter", [NewtestController::class, "getter"]);
            Route::get("/", [NewtestController::class, "get"]);
            Route::post("/", [NewtestController::class, "add"]);
            Route::put("/{id}", [NewtestController::class, "update"]);
            Route::delete("/many", [NewtestController::class, "removeMany"]);
            Route::delete("/{id}", [NewtestController::class, "remove"]);
        });

        Route::prefix("test")->group(function () {
            Route::get("getter", [TestController::class, "getter"]);
            Route::get("/", [TestController::class, "get"]);
            Route::post("/", [TestController::class, "add"]);
            Route::put("/{id}", [TestController::class, "update"]);
            Route::delete("/many", [TestController::class, "removeMany"]);
            Route::delete("/{id}", [TestController::class, "remove"]);
        });

