<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $connection = 'mysql';
    protected $table = 'customer';
    protected $fillable = [
'customerid', 'CustomerNo', 'CustomerName', 'customeremail', 'customerphone', 'MaritalStatusID', 'Gender', 'passwd', 'CustomerTypeID', 'customertype', 'CustomerGroupID', 'TermOfPaymentID', 'DeliveryTermID', 'AgeRangeID', 'WarehouseID', 'WarehouseNo', 'ModeOfDeliveryID', 'SalesTaxGroupID', 'TaxExemptNo', 'Description', 'activationcode', 'userIPAddress', 'submittedBy', 'submittedDate', 'DataStatusID', 'companyname', 'contactname', 'birthdate', 'RegionID', 'CityID', 'ProvinceID', 'CountryID', 'City', 'Address', 'Postalcode', 'fax', 'MessengerNo', 'GPSlatitude', 'GPSlongitude', 'Customer_Owner', 'Customer_FieldID', 'AccountOfficerID', 'creditlimit', 'notes', 'Gambar1', 'Gambar2', 'Company_ID', 'LinkTo', 'Tag', 'Keywords', 'FolderNo', 'DocumentLibraryID', 'recordowner', 'datecreated', 'createdby', 'datemodified', 'lastmodifiedby', 'LanguageID', 'CorrespondenceTypeID', 'IsByEmail', 'IsByMessenger', 'EducationDegreeID', 'CustomerCategoryID', 'LastOrderDate', 'AgentCode', 'IsByTelephone', 'Phone', 'LastContactDate', 'LastContactTime', 'LastContactByID', 'JournalContactID', 'BranchID', 'DivisionID', 'MainBankID', 'MainBankAccountName', 'MainBankAccountNo', 'MainBankBranch', 'Sales_code', 'Update_tele', 'StSrc', 'IsBySMS', 'IsActive', 'TelemarketingID', 'MobilePhone', 'Email2', 'Email3', 'nip_telemarketing', 'nip_sales_va', 'Hp2', 'Hp3', 'MainBankVirtualAcctounNo', 'StatusID', 'IsNotSend', 'IsSendNewsletter', 'ChannelID', 'TwitterID', 'FBid', 'IGid', 'db_from', 'kirim_wa', 'startdate', 'ProductCategoryID', 'commit_start', 'commit_end', 'Province', 'DataSourceID', 'DataFromID', 'JournalEventID', 'SalesProgramID', 'ActivityTypeID', 'LocationOfficeID', 'Parent_CustomerID', 'Parent_CustomerNo', 'Parent_CustomerName', 'NoOfChild', 'IsParent', 'SoAPDF', 'TakenFrom', 'LastSoA', '3cx_ext', '3cx_callStatus', '3cx_callResult', '3cx_callPriority', 'campaignId_3cx', '3cx_callPeriod', '3cx_callLast','3cx_queue'
    ];

    public $timestamps = false;
    
}
