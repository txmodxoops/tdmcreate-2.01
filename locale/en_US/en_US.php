<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.6.0
 * @author          DuGris (aka Laurent JEN)
 * @version         $Id: en_US.php 13058 2015-05-06 14:56:29Z txmodxoops $
 */
defined("XOOPS_ROOT_PATH") or die("Restricted access");
/**
 * Naming conventions
 * - All translations must be enclosed with ""
 * - All translations must be Uppercase first, do not use CamelCase
 *   Good ex: "User groups"
 *   Bad ex: "user groups" or "User Groups"
 * - All keys must be as descriptive as possible.
 * - All keys must use complete words between each '_',
 * - Keys should be prepended with identifiers in following cases:
 *   F_ Formatted, use this when strings are parsed with sprintf()
 *   A_ Action, use this when using a single word which is a verb
 *   S_ Success, use this for success messages and exclamations
 *   E_ Error, use this for error messages
 *   C_ Colon, use this when string ends with a colon ":"
 *   Q_ Question, use this when string is a question
 *   L_ List, use this for lists of strings, ex: months, countries, languages, etc
 *      Use L_NAME_ to group list items by name, ex: L_COUNTRY_
 * - Chain keys alphabetically with the exception of F, F always comes in last
 *   ex: SF_ (formatted success message), EF_ (formatted error message)
 * - Special cases:
 *   CONF_ Configs, prepend this for your module configs.
 *      Config keys are stored in database, try to make them as short as possible!
 *   _DESC Description, append this for configs description
 */
class TDMCreateLocaleEn_US /*extends XoopsLocaleEn_US*/
{    
	const A_ADD_EXTENSION = "Add Extension";
	const A_ADD_LOCALE = "Add Locale";
	const A_ADD_FIELDS = "Add Fields";
	const A_ADD_MODULE = "Add Module";
	const A_ADD_TABLE = "Add Table";

	const A_EDIT_EXTENSION = "Edit Extension";
	const A_EDIT_FIELDS = "Edit Fields";
	const A_EDIT_LOCALE = "Edit Locale";
	const A_EDIT_MODULE = "Edit Module";
	const A_EDIT_TABLE = "Edit Table";	
	
	const A_LIST_EXTENSIONS = "List of Extensions";
	const A_LIST_FIELDS = "List of Fields";
	const A_LIST_LOCALE = "List of Locale";
	const A_LIST_MODULES = "List of Modules";
	const A_LIST_TABLES = "List of Tables";
	
    const ADMIN_MENU1 = "Dashboard";
	const ADMIN_MENU2 = "Modules";
	const ADMIN_MENU3 = "Tables";
	const ADMIN_MENU4 = "Fields";
	const ADMIN_MENU5 = "Locale";
	const ADMIN_MENU6 = "Import";
	const ADMIN_MENU7 = "Building";
	const ADMIN_MENU8 = "Information";
	
	const BUILD_EXTENSION  = "Build Extension";
	const BUILD_MODULE  = "Build Module";
	
	const CHANGE_DISPLAY = "Change Display";
	const DASHBOARD = "Dashboard";

	const C_ADMIN = "Visible Admin:";
	const C_AUTHOR_MAIL = "Author Email:";
	const C_AUTHOR_WEBSITE_URL = "Author Site Url:";
	const C_AUTHOR_WEBSITE_NAME = "Author Site Name:";
	const C_BLOCKS = "Enable Blocks:";
	const C_CHECK_ALL = "Check All:";
	const C_COMMENTS = "Enable Comments:";
	const C_CREDITS = "Credits:";
	const C_DEMO_SITE_URL = "Demo Site Url:";
	const C_DEMO_SITE_NAME = "Demo Site Name:";
	const C_DIRECTORY_NAME = "Directory Name:";
	const C_DONATIONS = "Button Donations:";
	const C_EXTENSION = "Extension:";
	const C_IMAGE = "Image:";
	const C_LICENSE = "License:";
	const C_MANUAL = "Manual:";
	const C_MANUAL_FILE = "Manual File:";
	const C_MIN_ADMIN = "Minimum Admin:";
	const C_MIN_MYSQL = "Minimum MYSQL:";
	const C_MIN_PHP = "Minimum PHP:";
	const C_MIN_XOOPS = "Minimum XOOPS:";
	const C_NAME = "Name:";
	const C_PERMISSIONS = "Enable Permissions:";
	const C_NOTIFICATIONS = "Enable Notifications:";
	const C_IN_ROOT = "Copy of this module in root/modules:";
	const C_OPTIONS = "Options:";	
	const C_RELEASE = "Release:";
	const C_RELEASE_FILE = "Release File:";
	const C_RELEASE_INFO = "Release Info:";	
	const C_SEARCH = "Enable Search:";
	const C_SINCE = "Since:";
	const C_STATUS = "Status:";
	const C_SUBMENU = "View Submenu:";	
	const C_SUBVERSION = "Subversion module:";
	const C_SUPPORT_URL = "Support URL:";
	const C_SUPPORT_NAME = "Support Name:";
	const C_UPLOAD_FILE = "Upload file:";
	const C_USER = "Visible User:";
	const C_VERSION = "Version:";
	const C_WEBSITE_URL = "Module Website URL:";
	const C_WEBSITE_NAME = "Module Website Name:";	
	const C_MODULE_OR_EXTENSION_DESC = "If you choose to create an extension, the checkbox will be checked";
	
	const CH_NUMBER_ID = "N&176;&nbsp;ID";
	
	const CONF_ACTIVE_BLOCKS = "Allow Blocks";
	const CONF_ACTIVE_SEARCH = "Allow Search";
	const CONF_ACTIVE_COMMENTS = "Allow Comments";
	const CONF_ADMIN_PAGER = "Admin per page";
	const CONF_ADMIN_PAGER_DESC = "Set number of tables to view per page in admin.";
	const CONF_AUTHOR = "Module Author";
	const CONF_AUTHOR_EMAIL = "Author's Email";
	const CONF_AUTHOR_WEBSITE_URL = "Author's Website URL";
	const CONF_AUTHOR_WEBSITE_NAME = "Author's Website Name";
	const CONF_ACTIVE_NOTIFICATIONS = "Allow Notifications";
	const CONF_ACTIVE_PERMISSIONS = "Allow Permissions";
	const CONF_INROOT_COPY = "Copy this module also in root/modules";
	const CONF_BREAK_GENERAL = "General settings";
	const CONF_BREAK_MODULE = "Module settings";
	const CONF_CREDITS = "Credits";
	const CONF_DATE_FORMAT = "Date Format";
	const CONF_DEMO_SITE_URL = "Demo Website URL";
	const CONF_DEMO_SITE_NAME = "Demo Website Name";
	const CONF_DESCRIPTION = "Module Description";
	const CONF_DIRECTORY_NAME = "Directory Name";
	const CONF_DISPLAY_ADMIN_SIDE = "Visible in Admin Panel";
	const CONF_DISPLAY_SUBMENU = "Display Submenu";
	const CONF_DISPLAY_USER_SIDE = "Visible in User side";	
	const CONF_EDITOR = "Editor";
	const CONF_EDITOR_DESC = "Select an editor to write";
	const CONF_IMAGE = "Modules Image";
	const CONF_IS_EXTENSION = "If from beginning is an extension, set Yes";
	const CONF_LICENSE = "License";
	const CONF_LICENSE_URL = "License URL";
	const CONF_MANUAL = "Modules Manual";
	const CONF_MANUAL_FILE = "Manual file";
	const CONF_MAX_UPLOAD_SIZE = "Maximum size of images";
	const CONF_MAX_UPLOAD_SIZE_DESC = "Set maximum size of images in Bytes";
	const CONF_MIMETYPES = "Mime Types";
	const CONF_MIMETYPES_DESC = "Mime Types for images";
	const CONF_MODULE_DESCRIPTION = "Module Description";
	const CONF_NAME = "Module Name";	
	const CONF_DONATIONS = "Paypal Donations";
	const CONF_RELEASE_DATE = "Release Date";
	const CONF_RELEASE_DATE_DESC = "Date Format";
	const CONF_RELEASE_INFO = "Modules Release Info";
	const CONF_RELEASE_FILE = "Module Release File";	
	const CONF_REVISION = "Svn Revision";
	const CONF_STATUS = "Module status";
	const CONF_SUPPORT_URL = "Support Website URL";
	const CONF_SUPPORT_NAME = "Support Website";
	const CONF_VERSION = "Module Version";
	const CONF_WEBSITE_URL = "Module website URL";
	const CONF_WEBSITE_NAME = "Module Website name";	
	const CONF_SINCE = "Since";
	const CONF_MIN_ADMIN = "Minimum Admin";
	const CONF_MIN_MYSQL = "Minimum MYSQL";
	const CONF_MIN_PHP = "Minimum PHP";
	const CONF_MIN_XOOPS = "Minimum XOOPS";
	
	const CONST_MODULES = "Select the module you want to build";
	const CONST_TABLES = "Select the table you want to build";

	const CONST_OK_ARCHITECTURE = "Structure of module (index.html, admin, icons, images, locale, templates, ...)";
	const CONST_OK_COMMENTS = "Created files for comments";
	const CONST_OK_DOCS = "Created <b>%s</b> file in the docs folder";
	const CONST_OK_CSS = "Created <b>%s</b> file in the css folder";
	const CONST_OK_ROOTS = "Created <b>%s</b> file in the root of this module";
	const CONST_OK_CLASSES = "Created <b>%s</b> file in the class folder";
	const CONST_OK_BLOCKS = "Created <b>%s</b> file in the blocks folder";
	const CONST_OK_SQL = "Created <b>%s</b> file in your sql folder";
	const CONST_OK_ADMINS = "Created <b>%s</b> file in the admin folder";
	const CONST_OK_LANGUAGES = "Created <b>%s</b> file in the locale folder";
	const CONST_OK_INCLUDES = "Created <b>%s</b> file in the include folder";
	const CONST_OK_TEMPLATES = "Created <b>%s</b> file in the templates folder";
	const CONST_OK_TEMPLATES_BLOCS = "Created <b>%s</b> file in the templates/blocks folder";
	const CONST_OK_TEMPLATES_ADMIN = "Created <b>%s</b> file in the templates/admin folder";

	const CONST_NOTOK_ARCHITECTURE = "Problems: Creating the module (index.html, icons ,...)";
	const CONST_NOTOK_COMMENTS = "Problems: Creating files for comments";
	const CONST_NOTOK_DOCS = "Problems: Creating <b>%s</b> file in the docs folder";
	const CONST_NOTOK_CSS = "Problems: Creating <b>%s</b> file in the css folder";
	const CONST_NOTOK_ROOTS = "Problems: Creating <b>%s</b> file in the root of this module";
	const CONST_NOTOK_CLASSES = "Problems: Creating <b>%s</b> file in your class folder";
	const CONST_NOTOK_BLOCKS = "Problems: Creating <b>%s</b> file in blocks folder";
	const CONST_NOTOK_SQL = "Problems: Creating <b>%s</b> file in sql folder";
	const CONST_NOTOK_ADMINS = "Problems: Creating <b>%s</b> file in the admin folder";
	const CONST_NOTOK_LANGUAGES = "Problems: Creating <b>%s</b> file in the locale folder";
	const CONST_NOTOK_INCLUDES = "Problems: Creating <b>%s</b> file in the include folder";
	const CONST_NOTOK_TEMPLATES = "Problems: Creating <b>%s</b> file in the templates folder";
	const CONST_NOTOK_TEMPLATES_BLOCS = "Problems: Creating <b>%s</b> file in the templates/blocks folder";
	const CONST_NOTOK_TEMPLATES_ADMIN = "Problems: Creating <b>%s</b> file in the templates/admin folder";
		
	const CREATE_LOGO = "Create Logo";
	
	const ALL_TABS_TIPS = "<ul><li>Add, update, create or delete modules, extensions, tables, fields, import old modules</li></ul>";
	
	const DISPLAY_ADMIN = "Visible Admin";
	const DISPLAY_USER = "Visible User";	

	const IMPORTANT = "Required Information";
	const NOT_IMPORTANT = "Optional Information";	
	
	const E_NO_EXTENSIONS = "There aren't extensions";
	const E_NO_FIELDS = "There aren't fields";
	const E_NO_FIELDS_FORM = "There aren't form fields";
	const E_NO_IMPORTS = "There aren't old modules imported";
	const E_NO_LOCALES = "There aren't old defines imported";
	const E_NO_MODULES = "There aren't modules";
	const E_NO_TABLES = "There aren't tables";
	
	const E_DATABASE_ERROR = "Database Error";	
	const E_DATABASE_SQL_FILE_NOT_IMPORTED = "Database Error: Not sql file or data entered!";
	const E_SQL_FILE_DATA_NOT_MATCH = "File Error: data in sql file do not match. Row: %s";
	const E_FILE_NOT_OPEN_READING = "File Error: Could not open file for reading!";
	const E_FILE_NOT_UPLOADING = "File Error: upload in file: %s";
	
	const FIELDS_NUMBER = "Number of fields";	
	
	const F_FILES_PATH = "Files in %s ";
	const F_EDIT = "Modification";
	const F_DEL = "Clear";
	const FORM_OK = "Form ok";
	const INFO_TABLE = "Information on the table";
	const INFO_TABLE_FIELD = "You can add your choice 3 fields in this table: '<b>table</b>'_submitter, '<b>table</b>'_created, '<b>table</b>'_online";

	const F_INDEX_NMTOTAL = "There are %s modules in the Database";
	const F_INDEX_NETOTAL = "There are %s extensions in the Database";
	const F_INDEX_NTTOTAL = "There are %s tables in the Database";
	const F_INDEX_NFTOTAL = "There are %s fields in the Database";
	const F_INDEX_NLTOTAL = "There are %s total constants locales in the Database";
	const F_INDEX_NITOTAL = "There are %s old modules imported in the Database";
	
	const INDEX_STATISTICS = "Statistics";
	const L_BUILDING_FAILED = "Building Failed";
	const L_BUILDING_FILES = "Building Files";
	const L_BUILDING_SUCCESS = "Building Success";
			
	const MODULE_IMPORTANT = "Required Information";
    const MODULE_NAME = "TDMCreate";
    const MODULE_DESC = "Module for creating others modules";
	const MODULE_INFORMATION = "Information";
	const MODULE_NOT_IMPORTANT = "Optional Information";	
	
	const MODULE_FIELDS_NUMBER = "Fields Number";
	const MODULE_BLOCKS = "Blocks";
	const MODULE_TIPS = "<ul><li>Add, edit or delete modules</li></ul>";
	const MODULE_SELECT_DEFAULT = "Select Module or Extension";
	
	const QF_ARE_YOU_SURE_TO_DELETE = "Are you sure you want to delete: <span class='red bold'>%s</span>?";
	const QF_ARE_YOU_SURE_TO_RENEW = "Are you sure you want to renew: <span class='red bold'>%s</span>?";
	const QC_ISEXTENSION = "Is an Extension?";
	
	const S_SAVED = "Successfully saved";
	const S_DELETED = "Successfully deleted";
		
	const S_DELETED_SUCCESS	= "Deleted Successfully";
	const S_DATA_ENTERED = "Data entered successfull!";
	
	const OPTIONS_CHECK = "Options Check";
	const MODULE_OPTIONS_DESC = "Choose which option will be activated";
	// Options Modules Check
	const O_MODULE_EXTENSION = "Is an Extension?";
	const O_MODULE_ADMIN = "Visible Admin";
    const O_MODULE_USER = "Visible User";
    const O_MODULE_SUBMENU = "View Submenu";
    const O_MODULE_BLOCKS = "Enable Blocks";
    const O_MODULE_SEARCH = "Enable Search";
    const O_MODULE_COMMENTS = "Enable Comments";
    const O_MODULE_PERMISSIONS = "Enable Permissions";
    const O_MODULE_NOTIFICATIONS = "Enable Notifications";
    const O_MODULE_ROOT = "Copy of this module in root/modules";
	const TABLE_OPTIONS_DESC = "Choose which option will be activated";
	// Options Tables Check
	const O_TABLE_ADMIN = "Add in Admin Panel";
	const O_TABLE_BLOCKS = "Add in Block file";
	const O_TABLE_BROKEN = "Add in Broken file";
	const O_TABLE_COMMENTS = "Add in Comments file";
	const O_TABLE_NOTIFICATIONS = "Add in Notifications file";
	const O_TABLE_PDF = "Add in Pdf file";
	const O_TABLE_PERMISSIONS = "Add in Permissions file";
	const O_TABLE_PRINT = "Add in Print file";
	const O_TABLE_RATE = "Add in Rate file";
	const O_TABLE_RSS = "Add in Rss file";
	const O_TABLE_SEARCH = "Add in Search file";
	const O_TABLE_SINGLE = "Add in Single file";
	const O_TABLE_SUBMENU = "Add in Submenu";
	const O_TABLE_SUBMIT = "Add in Submit file";
	const O_TABLE_TAG = "Add in Tag file";
	const O_TABLE_USER = "Add in User Side";
	const O_TABLE_VISIT = "Add in Visit file";
	
	const TABLE_ADD = "Add a new table";
	const TABLE_EDIT = "Edit Table";
	const TABLE_EXIST = "The name specified for this table is already in use";
	const TABLE_MODULES = "Choose a module";
	const TABLE_NAME = "Table Name";
	const TABLE_NAME_DESC = "Unique Name for this Table";
	const TABLE_SOLE_NAME = "Table Singular Name";
	const TABLE_SOLE_NAME_DESC = "Singular  Name: It's recommended to use singular word (i.e.: <span style='text-decoration: underline;'>category</span> for admin buttons)";
	const TABLE_FIELDS_NUMBER = "Fields Number";
	const TABLE_FIELDS_NUMBER_DESC = "Number of fields for this table";
	const TABLE_FIELD_NAME = "Field Name";
	const TABLE_FIELD_NAME_DESC = "This is the prefix of field name (optional)<br />If you leave the field blank, doesn't appear anything in the fields of the next screen, otherwise you'll see all the fields with a prefix type (e.g: <span class='bold'>fieldname_</span>)";
	const TABLE_ORDER = "Table Order";
	const TABLE_ORDER_DESC = "Create a Table Order for index and menu of the new modules";
	
	const TABLE_IMAGE = "Table Logo";
	
	const TABLE_CATEGORY = "This table is a category or topic?";
	const TABLE_CATEGORY_DESC = "<b class='red bold'>WARNING</b>: <i>Once you have used this option for this module, and edit this table, will not be displayed following the creation of other tables</i>";
	const TABLE_AUTOINCREMENT = "Auto Increment";
	const TABLE_AUTOINCREMENT_DESC = "Check this option if table have the Auto Increment ID";	
	
	const TABLE_ADMIN = "Display Admin";
	const TABLE_USER = "Display User";
	const TABLE_TIPS = "<ul><li>Add, edit or delete tables</li></ul>";
	
	const TABLE_ID = "Id";
	const TABLE_ADMIN_LIST = "Display Admin";
	const TABLE_USER_LIST = "Display User";
	const TABLE_SUBMENU_LIST = "Display Submenu";
	const TABLE_SEARCH_LIST = "Active Search";
	const TABLE_COMMENTS_LIST = "Active Comments";
	const TABLE_NOTIFICATIONS_LIST = "Active Notifications";

	const TABLE_IMAGE_DESC = "<span class='red bold'>Attention</span>: If you want to choose a new image, is best to name it with the module name before and follow with the name of the image so as not to overwrite any images with the same name, in the <span class='bold'>Frameworks/moduleclasses/moduleadmin/icons/32/</span>. Otherwise an other solution, would be to insert the images in the module, a new folder is created, with the creation of the same module - <span class='bold'>images/32</span>.";
	
	const TABLE_ERROR_NOTABLES = "There aren't tables";
	const TABLE_ERROR_NOMODULES = "There aren't modules";
	
	const FIELD_ADD = "Add fields";
	const FIELD_TIPS = "<ul><li>List, edit of field </li></ul>";
	const FIELD_EDIT = "Edit fields";
	const FIELD_NUMBER = "N&#176;";
	const FIELD_NAME = "Field Name";
	const FIELD_TYPE = "Type";
	const FIELD_VALUE = "Value";
	const FIELD_ATTRIBUTE = "Attribute";
	const FIELD_NULL = "Null";
	const FIELD_DEFAULT = "Default";
	const FIELD_KEY = "Key";
	const FIELD_AUTO_INCREMENT = " Auto Increment";

	const FIELD_OTHERS = "Others";
	const FIELD_ELEMENTS = "Options Elements";
	const C_FIELD_ELEMENT_NAME = "Form: Element";
	const C_FIELD_ADMIN = "Page: Show Admin Side";
	const C_FIELD_USER = "Page: Show User Side";
	const C_FIELD_BLOCK = "Block: View";
	const C_FIELD_MAINFIELD = "Table: Main Field";
	const C_FIELD_SEARCH = "Search: Index";
	const C_FIELD_REQUIRED = "Field: Required";
	const FIELD_ERROR_NOFIELDS = "There aren't fields";
	
	const ADMIN_SUBMIT = "Send";
	
	const PERMISSIONS = "Permissions";
	const FORM_ON = "Online";
	const FORM_OFF = "Offline";
    const PERMISSIONS_ACCESS = "Permission to view";
	const PERMISSIONS_SUBMIT = "Permission to submit";	
	const PERMISSIONS_APPROVE = "Permission to approve";

	const BLOCK_DAY = "Today";
	const BLOCK_RANDOM = "Random";
	const BLOCK_RECENT = "Recent";

	const MIMETYPES = "Mime types authorized for:";
	const MIMESIZE = "Allowable size:";
	const C_EDITOR = "Editor:";

	const EXTENSIONS_LIST = "Extensions List";
	const EXTENSION = "Extension";
	
	const MODULES_LIST = "Modules List";
	const MODULE = "Module";
	
	const TABLES_LIST = "Tables List";
	const TABLE = "Table";
	
	const FIELDS_LIST = "Fields List";
	const FIELD = "Field";

	const NOT_MODULES = "<span class='red bold'>No module created, must create at least one before</span>";
	const MODULEADMIN_MISSING = "Module Admin Missing, Pleace! Install this Framework";
	const MODULE_DISPLAY_SUBMENU = "Visible Submenu";
	const MODULE_ACTIVE_NOTIFY = "Enable Notifications";
	const NOT_INSERTED = "<span class='red bold'>The module is not saved,<br />it is likely that you have used a name that already exists,<br />please change name for a new module.</span>";

	const DELETE = "Delete";
	const UPLOADS = "Uploads";
	const CF_IMAGE_PATH = "Image Path: %s ";
	const SUBMENU = "Submenu";  
	const SEARCH = "Search";  
	const COMMENTS = "Comments";  
	const NOTIFIES = "Notifies";

	const MISSING = "Error: You don&#39;t use the Frameworks \"admin module\". Please install this Frameworks";
	const F_MAINTAINEDBY = "<span class='bold green'>%s</span><span class='small italic'> is maintained by the </span><a href='%s' title='Visit %s' class='tooltip' rel='external'>%s</a><span class='small italic'> and by </span><a href='http://www.xoops.org/modules/newbb/' title='Visit Xoops Community' class='tooltip' rel='external'>Xoops Community</a>";

	const IMPORT = "Import";
	const IMPORT_TIPS = "<ul><li>Import or delete tables of old modules</li></ul>";
	const IMPORT_OLD_MODULE = "Import old module";
	const IMPORTED = "Imported";
	const IMPORT_TITLE = "Form Import old module";
	const IMPORT_LIST = "List of old modules Imported";
	const IMPORTED_LIST = "Imported Modules List";

	const IMPORT_ID = "Id";
	const IMPORT_MID = "Module";
	const IMPORT_NAME = "Name";
	const IMPORT_TABLES_NUMBER = "Tables Number";
	const IMPORT_TABLE_NAME = "Table Name";
	const IMPORT_FIELDS_NUMBER = "Fields Number";
	const IMPORT_FIELD_NAME = "Field Name";
	
	const LOCALE_TITLE = "Form locale";
	const LOCALE_TIPS = "<ul><li>Import, add, edit or delete defines for locale files</li></ul>";
	const LOCALE_ID = "Id";
	const LOCALE_MID = "Module";
	const LOCALE_FILE_NAME = "File Name";
	const LOCALE_DEFINE = "Tables Number";
	const LOCALE_DESCRIPTION = "Table Name";
	
	const BUILDING_TITLE = "Building";
	const BUILDING_TIPS = "<ul><li>Build modules or extensions</li></ul>";
	const BUILDING_MODULES = "Building modules";
	const BUILDING_EXTENSIONS = "Building Extensions";
	const BUILDING_SELECT_DEFAULT = "Select Module or Extension";
	const BUILDING_EXECUTED = "Build Executed";
	const BUILDING_SUCCESS = "Success";
	const BUILDING_ERROR = "Error";
	const BUILDING_FORM = "Building Form";
	const BUILDING_DIRECTORY = "Files created in the directory <span class='bold'>uploads/tdmcreate/repository/%s</span> of the %s <span class='bold green'>%s</span>";
}