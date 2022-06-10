<?php
define( 'CP_DIRECTORY', 'administracija' );
define( 'BYPASS_UPGRADER_LOGIN', TRUE );

/* #######################################

	Constant - CP_DIRECTORY
	Use - Name of your admin CP directory when changed from the default of 'admin'
	Example value - 'newcpdirectory'

	Constant - IN_DEV
	Use - Places the system into developer mode (dev tools must be present)
	Example value - TRUE

	Constant - IPS_FOLDER_PERMISSION
	Use - Default permission folders will be set to for writable folders
	Example value - 0777

	Constant - FOLDER_PERMISSION_NO_WRITE
	Use - Default permission folders will be set to for writable folders
	Example value - 0755

	Constant - IPS_FILE_PERMISSION
	Use - Default permission folders will be set to for writable folders
	Example value - 0666

	Constant - FILE_PERMISSION_NO_WRITE
	Use - Default permission folders will be set to for writable folders
	Example value - 0644

	Constant - COOKIE_PREFIX
	Use - Prefix to add to any cookie. Helpful if you have cookies of the same name for other uses
	Example value - 'ips4_'

	Constant - UPGRADE_MANUAL_THRESHOLD
	Use - Row count in a table before manual query prompt will occur. Do not change unless you are 100% sure your server will run above this in all queries.
	Example value - 250000

	Constant - UPGRADE_LARGE_TABLE_SIZE
	Use - Size of table before manual query prompt will occur. Do not change unless you are 100% sure your server will run above this in all queries.
	Example value - 100000000
	Constant - USE_DEVELOPMENT_BUILDS
	Use - Adding a true value to this will allow the automatic upgrader to pick up public alpha and beta releases.
	Example value - TRUE

	Constant - TEMP_DIRECTORY
	Use - Temp directory to use. By default this will use your servers set temp directory
	Example value - '/some/full/path/'

	Constant - BYPASS_ACP_IP_CHECK
	Use - Removes the check of IP from your ACP
	Example value - TRUE

	Constant - RECOVERY_MODE
	Use - Used for recovery of the system when failure occurs in 3rd party items, preventing ACP access
	Example value - TRUE

	Constant - DISABLE_MFA
	Use - Disabled two factor authentication on the system.
	Example value - TRUE

	Constant - REBUILD_SLOW
	Use - Number of items to be rebuilt per-cycle for routines that take a while (change only if you are 100% sure your system will cope)
	Example value - 50

	Constant - REBUILD_NORMAL
	Use - Number of items to be rebuilt per-cycle for most routines (change only if you are 100% sure your system will cope)
	Example value - 250

	Constant - REBUILD_QUICK
	Use - Number of items to be rebuilt per-cycle for routines that are fast (change only if you are 100% sure your system will cope)
	Example value - 500


*/
?>