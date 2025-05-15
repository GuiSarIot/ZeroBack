<?php

namespace App\Http\Controllers\Emails;

//* controllers
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApiController;

//* services
use App\Http\Services\Emails\MailSendService;

//* libraries
use Illuminate\Http\Request;

class MailSendController extends Controller
{
    public function testMail(Request $request, MailSendService $mailSendService)
    {
        try {
            return ResponseApiController::success($mailSendService->testMail($request));
        } catch (\Throwable $th) {
            return ResponseApiController::error([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
        }
    }
}
