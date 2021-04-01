<?php 

/**
 * Memory module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Memory_controller extends Module_controller
{
	
	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
	}

	/**
	 * Default method
	 * @author tuxudo
	 *
	 **/
	function index()
	{
		echo "You've loaded the memory module!";
	}
    
     /**
     * REST API for retrieving memory upgradable for widget
     * @tuxudo
     *
     **/
     public function memory_upgradable_widget()
     {
        $sql = "SELECT COUNT(DISTINCT (CASE WHEN is_memory_upgradeable = '1' THEN 1 END)) AS upgradable,
						COUNT(DISTINCT (CASE WHEN is_memory_upgradeable = '0' THEN 1 END)) AS notupgradable
						FROM memory
                        LEFT JOIN reportdata USING (serial_number)
						".get_machine_group_filter()."
                        GROUP BY serial_number";

        $queryobj = new Memory_model();
        $obj->view('json', array('msg' => current(array('msg' => $queryobj->query($sql))))); 
     }

     /**
     * REST API for retrieving memory pressure for widget
     * @tuxudo
     *
     **/
     public function memory_pressure_widget()
     {
        $sql = "SELECT memorypressure, computer_name
						FROM memory
						LEFT JOIN machine USING (serial_number)
						LEFT JOIN reportdata USING (serial_number)
                        WHERE memorypressure <> ''
						".get_machine_group_filter('AND')."
						ORDER BY memorypressure DESC";

        $queryobj = new Memory_model();
        $obj->view('json', array('msg' => current(array('msg' => $queryobj->query($sql))))); 
     }
    
	/**
     * Retrieve data in json format
     *
     **/
    public function get_memory_data($serial_number = '')
    {
        // Remove non-serial number characters
        $serial_number = preg_replace("/[^A-Za-z0-9_\-]]/", '', $serial_number);

        $sql = "SELECT memorypressure, free, active, inactive, wireddown, speculative, throttled, purgeable, reactivated, filebacked, anonymous, storedincompressor, occupiedbycompressor, swapfree, swapused, swaptotal,swapins, swapouts, pageins, pageouts, swapencrypted
                        FROM memory
                        WHERE serial_number = '$serial_number'";

        $queryobj = new Memory_model();
        $obj->view('json', array('msg' => current(array('msg' => $queryobj->query($sql))))); 
    }

    /**
     * Retrieve data in json format
     *
     **/
    public function get_ram_data($serial_number = '')
    {
        // Remove non-serial number characters
        $serial_number = preg_replace("/[^A-Za-z0-9_\-]]/", '', $serial_number);

        $sql = "SELECT name, dimm_size, dimm_speed, dimm_type, dimm_status, dimm_manufacturer, dimm_part_number, dimm_serial_number, dimm_ecc_errors, global_ecc_state, is_memory_upgradeable
                        FROM memory
                        WHERE serial_number = '$serial_number'";

        $queryobj = new Memory_model();
        $obj->view('json', array('msg' => current(array('msg' => $queryobj->query($sql))))); 
    }
    
} // END class Memory_controller
