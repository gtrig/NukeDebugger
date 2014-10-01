<?php
include('helpers/NukeDebugger/config.php');
class NukeDebugger
{
    public $data_array;
    public $data_sql;
    public $data_text;
    public $enable;
    
    public function addArray($data,$description)
    {
        $entry['data']=$data;
        $entry['description']=$description;
        $entry['backtrace']=debug_backtrace();
        $this->data_array[]=$entry;
        if(!$this->enable) $this->enable();
    }
    
    public function addText($data,$description){
        $entry['data']=$data;
        $entry['description']=$description;
        $entry['backtrace']=debug_backtrace();
        $this->data_text[]=$entry;
        if(!$this->enable) $this->enable();
    }
    
    public function addSql($data,$description){
        $entry['data']=$data;
        $entry['description']=$description;
        $entry['backtrace']=debug_backtrace();
        $this->data_sql[]=$entry;
        if(!$this->enable) $this->enable();
    }
    
    public function enable(){
        $this->enable_backtrace = debug_backtrace();
        $this->enable = true;
    }
    
    public function display()
    {
        ob_start();
        include nsdg_path."template.php";
        $data = ob_get_contents();
        ob_end_clean();
        ?>
        
        <script type="text/javascript">        
        debug_window = window.open("","NukeDebugger Output","width=680,height=600,resizable,scrollbars=yes");
        debug_window.document.write("<?php echo str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$data), "\0..\37'\\/")));?>");
        debug_window.document.close();
        </script>
        <?php
    }
}
?>