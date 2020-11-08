<?php


namespace App\Domain\Model\Patient;


class PatientEvents
{
    public const  CREATED = 'patient.created';
    public const  UPDATED = 'patient.updated';
    public const LISTED = 'patient.listed';
    public const BEFORE_DELETE = 'patient.before_delete';
    public const DELETED = 'patient.deleted';
}