<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class OfficialMember extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory;
    use CanResetPassword;
    use Notifiable;

    protected $table = 'officialmembers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Basic Information
        'member_id',
        'member_number',
        'last_name',
        'first_name',
        'middle_name',
        'place_of_birth',
        'birthdate',
        'age',
        'gender',
        'religion',
        'nationality',
        'civil_status',

        // Contact Information
        'email',
        'contact_number',

        // Address
        'street_address',
        'province',
        'city',
        'barangay',

        // Additional Information
        'year_of_stay',
        'house_ownership',
        'zip_code',

        // Emergency Contact
        'ec_fullname',
        'ec_gender',
        'ec_email',
        'ec_contact_number',
        'ec_address',
        'ec_relationship',

        // Employment Information
        'employment_status',
        'source_of_funds',
        'employer_business_name',
        'occupation',
        'company_business_address',
        'gross_monthly_income',
        'nature_type_of_employment_business',
        'sss_gsis_no',
        'tin_no',

        // Attachments
        'proof_of_billing',
        'two_by_two_picture',
        'valid_id',

        // Approval
        'ApprovedBy',
        'username',
        'password',
        'must_change_password',
    ];

    /**
     * The attributes that should be hidden for arrays and JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token', // Optional: useful if you use "remember me"
    ];

    protected $casts = [
        'must_change_password' => 'boolean',
    ];

    /**
     * Automatically hash password when setting it.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Use username (email string) as the password-reset identifier.
     * (Email column is encrypted and not searchable.)
     */
    public function getEmailForPasswordReset()
    {
        return (string) ($this->username ?? '');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MemberResetPasswordNotification((string) $token));
    }

        public function casts(): array
    {
        return [
            // Basic Information
            'last_name' => 'encrypted',
            'first_name' => 'encrypted',
            'middle_name' => 'encrypted',
            'place_of_birth' => 'encrypted',
            'birthdate' => 'encrypted',
            'age' => 'encrypted',
            'gender' => 'encrypted',
            'religion' => 'encrypted',
            'nationality' => 'encrypted',
            'civil_status' => 'encrypted',

            // Contact Information
            'email' => 'encrypted',
            'contact_number' => 'encrypted',

            // Address
            'street_address' => 'encrypted',
            'province' => 'encrypted',
            'city' => 'encrypted',
            'barangay' => 'encrypted',

            // Additional Information
            'year_of_stay' => 'encrypted',
            'house_ownership' => 'encrypted',
            'zip_code' => 'encrypted',

            // Emergency Contact
            'ec_fullname' => 'encrypted',
            'ec_gender' => 'encrypted',
            'ec_email' => 'encrypted',
            'ec_contact_number' => 'encrypted',
            'ec_address' => 'encrypted',
            'ec_relationship' => 'encrypted',

            // Employment Information
            'employment_status' => 'encrypted',
            'source_of_funds' => 'encrypted',
            'employer_business_name' => 'encrypted',
            'occupation' => 'encrypted',
            'company_business_address' => 'encrypted',
            'gross_monthly_income' => 'encrypted',
            'nature_type_of_employment_business' => 'encrypted',
            'sss_gsis_no' => 'encrypted',
            'tin_no' => 'encrypted',

            // Attachments
            'proof_of_billing' => 'encrypted',
            'two_by_two_picture' => 'encrypted',
            'valid_id' => 'encrypted',

            // Approval
            'ApprovedBy' => 'encrypted',
        ];
    }

}
