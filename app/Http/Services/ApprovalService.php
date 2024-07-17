<?php

namespace App\Http\Services;

use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalService
{
    private $logSvc;

    public function __construct()
    {
        $this->logSvc = new LogService();
    }

    public function update(Request $request, Approval $approval)
    {
        try {
            DB::beginTransaction();

            $approval->fill($request->only('status', 'comments'))->save();

            $this->logSvc->create("memperbarui persetujuan untuk permintaan id " . $approval->reservation_id);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            error_log("ApprovalService: " . $e->getMessage());

            throw new \Exception("failed to update approval");
        }
    }
}
