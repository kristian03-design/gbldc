<?php

namespace App\Http\Controllers;

use App\Models\loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewLoanRecordFromHistory extends Controller
{
    public function view($loan_number, $member_id, $type = null){
        $Review = loan::where('loan_number', $loan_number)->first();

        if (!$Review) {
            abort(404, "Loan record not found.");
        }

        // image handler
        $g1FilePath = $Review->loan_rec_g1_valid_id;
        $g2FilePath = $Review->loan_rec_g2_valid_id;
        $proofFilePath = $Review->loan_rec_proof_of_income;

        $filesExist = true;
        if (empty($g1FilePath) || !Storage::exists($g1FilePath)) {
            $filesExist = false;
        }
        if (empty($g2FilePath) || !Storage::exists($g2FilePath)) {
            $filesExist = false;
        }
        if (empty($proofFilePath) || !Storage::exists($proofFilePath)) {
            $filesExist = false;
        }

        if (!$filesExist) {
            abort(404, "One or more files not found.");
        }

        $g1FileContents = Storage::get($g1FilePath);
        $g2FileContents = Storage::get($g2FilePath);
        $proofFileContents = Storage::get($proofFilePath);

        $g1MimeType = Storage::mimeType($g1FilePath);
        $g2MimeType = Storage::mimeType($g2FilePath);
        $proofMimeType = Storage::mimeType($proofFilePath);

        $g1Base64 = base64_encode($g1FileContents);
        $g2Base64 = base64_encode($g2FileContents);
        $proofBase64 = base64_encode($proofFileContents);

        return view('Administrator.ViewLoanRecordFromHistory', compact('Review','g1MimeType','g1Base64','g2MimeType',
                                                                    'g2Base64','proofMimeType','proofBase64',
                                                                    'g1FileContents','g2FileContents','proofFileContents',
                                                                    'member_id', 'type'));
    }
}
