<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ViewLoanAppFulll extends Controller
{
    public function ViewFullLoanApp($id)
    {
        $GetLoanForm = LoanApplication::findOrFail($id);

        // Initialize variables for file handling
        $g1Base64 = null;
        $g2Base64 = null;
        $proofBase64 = null;
        $g1MimeType = 'image/jpeg';
        $g2MimeType = 'image/jpeg';
        $proofMimeType = 'image/jpeg';
        $g1FilePath = null;
        $g2FilePath = null;
        $proofFilePath = null;

        // Handle First Guarantor ID
        if (!empty($GetLoanForm->g1_valid_id) && Storage::exists($GetLoanForm->g1_valid_id)) {
            $g1FilePath = $GetLoanForm->g1_valid_id;
            $g1FileContents = Storage::get($g1FilePath);
            $g1MimeType = Storage::mimeType($g1FilePath);
            $g1Base64 = base64_encode($g1FileContents);
        }

        // Handle Second Guarantor ID
        if (!empty($GetLoanForm->g2_valid_id) && Storage::exists($GetLoanForm->g2_valid_id)) {
            $g2FilePath = $GetLoanForm->g2_valid_id;
            $g2FileContents = Storage::get($g2FilePath);
            $g2MimeType = Storage::mimeType($g2FilePath);
            $g2Base64 = base64_encode($g2FileContents);
        }

        // Handle Proof of Income
        if (!empty($GetLoanForm->proof_of_income) && Storage::exists($GetLoanForm->proof_of_income)) {
            $proofFilePath = $GetLoanForm->proof_of_income;
            $proofFileContents = Storage::get($proofFilePath);
            $proofMimeType = Storage::mimeType($proofFilePath);
            $proofBase64 = base64_encode($proofFileContents);
        }

        $Review = $GetLoanForm;
        $interestTiers = config('loan_interest_tiers.tiers', []);

        return view("Administrator.LoanApplicationFormReview", compact(
            "g1Base64", "g2Base64", "proofBase64",
            "g1MimeType", "g2MimeType", "proofMimeType",
            "g1FilePath", "g2FilePath", "proofFilePath", "Review", "interestTiers"
        ));
    }
}
