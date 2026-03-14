<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrationModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;



class redirectMemberForm extends Controller
{
    public function redirectMF($id){
        $registrationForm = registrationModel::findOrFail($id);
        $Proof_of_Billings_filePath = $registrationForm->proof_of_billing;
        $two_by_two_picture_filePath = $registrationForm->two_by_two_picture;
        $valid_id_filePath = $registrationForm->valid_id;

        $filesExist = true;
        if (empty($Proof_of_Billings_filePath) || !Storage::exists($Proof_of_Billings_filePath)) {
            $filesExist = false;
        }
        if (empty($two_by_two_picture_filePath) || !Storage::exists($two_by_two_picture_filePath)) {
            $filesExist = false;
        }
        if (empty($valid_id_filePath) || !Storage::exists($valid_id_filePath)) {
            $filesExist = false;
        }

        if (!$filesExist) {
            abort(404, "One or more files not found.");
        }
        $Review = $registrationForm;
        $Proof_of_Billings_FileContents = Storage::get($Proof_of_Billings_filePath);
        $two_by_two_picture_FileContents = Storage::get($two_by_two_picture_filePath);
        $valid_id_FileContents = Storage::get($valid_id_filePath);

        $Proof_of_Billings_MimeType = Storage::mimeType($Proof_of_Billings_filePath);
        $two_by_two_picture_MimeType = Storage::mimeType($two_by_two_picture_filePath);
        $valid_id_MimeType = Storage::mimeType($valid_id_filePath);

        $Proof_of_Billings_Base64 = base64_encode($Proof_of_Billings_FileContents);
        $two_by_two_picture_Base64 = base64_encode($two_by_two_picture_FileContents);
        $valid_id_Base64 = base64_encode($valid_id_FileContents);


        // #region agent log
        try {
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'pre-fix-admin-view-membership',
                'hypothesisId' => 'H1',
                'location' => 'redirectMemberForm.php:redirectMF',
                'message' => 'Admin view membership form - field presence',
                'data' => [
                    'registration_id' => (int) $id,
                    'has_ec_address' => isset($registrationForm->ec_address) && $registrationForm->ec_address !== '' && $registrationForm->ec_address !== null,
                    'has_ec_email' => isset($registrationForm->ec_email) && $registrationForm->ec_email !== '' && $registrationForm->ec_email !== null,
                    'has_city' => isset($registrationForm->city) && $registrationForm->city !== '' && $registrationForm->city !== null,
                    'has_proof_of_billing' => !empty($Proof_of_Billings_filePath),
                    'has_two_by_two' => !empty($two_by_two_picture_filePath),
                    'has_valid_id' => !empty($valid_id_filePath),
                ],
                'timestamp' => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
        }
        // #endregion

        return view('Administrator.ViewMembershipForm', compact(
            'Proof_of_Billings_filePath','two_by_two_picture_filePath','valid_id_filePath',
            'Proof_of_Billings_MimeType','two_by_two_picture_MimeType','valid_id_MimeType',
            'Proof_of_Billings_Base64','two_by_two_picture_Base64','valid_id_Base64','Review'
        ));
    }
}
