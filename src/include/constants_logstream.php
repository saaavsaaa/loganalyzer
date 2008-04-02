<?php
/*
	*********************************************************************
	* Copyright by Adiscon GmbH | 2008!									*
	* -> www.phplogcon.org <-											*
	*																	*
	* Use this script at your own risk!									*
	* -----------------------------------------------------------------	*
	* Some constants													*
	*																	*
	* -> Stuff which has to be static and predefined					*
	*																	*
	* All directives are explained within this file						*
	*********************************************************************
*/

// --- Avoid directly accessing this file! 
if ( !defined('IN_PHPLOGCON') )
{
	die('Hacking attempt');
	exit;
}
// --- 

// --- Some custom defines

// Properties we need from the stream class
define('SYSLOG_DATE', 'timereported');
define('SYSLOG_FACILITY', 'syslogfacility');
define('SYSLOG_FACILITY_TEXT', 'syslogfacility-text');
define('SYSLOG_SEVERITY', 'syslogseverity');
define('SYSLOG_SEVERITY_TEXT','syslogseverity-text');
define('SYSLOG_HOST', 'FROMHOST');
define('SYSLOG_SYSLOGTAG', 'syslogtag');
define('SYSLOG_MESSAGE', 'msg');
define('SYSLOG_MESSAGETRUNSCATED', 'msgtrunscated');
define('SYSLOG_MESSAGETYPE', 'IUT');
define('SYSLOG_PROCESSID', 'procid');

// MonitorWare InfoUnit Defines
define('IUT_Unknown', '0');
define('IUT_Syslog', '1');
define('IUT_Heartbeat', '2');
define('IUT_NT_EventReport', '3');
define('IUT_SNMP_Trap', '4');
define('IUT_File_Monitor', '5');
define('IUT_PingProbe', '8');
define('IUT_Port_Probe', '9');
define('IUT_NTService_Monitor', '10');
define('IUT_DiskSpace_Monitor', '11');
define('IUT_DB_Monitor', '12');
define('IUT_Serial_Monitor', '13');
define('IUT_CPU_Monitor', '14');
define('IUT_AliveMonRequest', '16');
define('IUT_SMTPProbe', '17');
define('IUT_FTPProbe', '18');
define('IUT_HTTPProbe', '19');
define('IUT_POP3Probe', '20');
define('IUT_IMAPProbe', '21');
define('IUT_NNTPProbe', '22');
define('IUT_WEVTMONV2', '23');
define('IUT_SMTPLISTENER', '24');
define('IUT_AliveMonECHO', '1999998');
define('IUT_MIAP_Receiver', '1999999');

?>