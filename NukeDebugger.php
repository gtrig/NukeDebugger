<?php
include('helpers/NukeDebugger/config.php');
class NukeDebugger
{
    public $data_array;
    public $data_sql;
    public $data_text;
    public $enable;
    public $forceText;
    private $start_time;
    private $end_time;
    public $log_sql;
    public $sql_queries_count;
    
    public function NukeDebugger()
    {
    	$this->start_time = microtime(true);
    }
    
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
    	$this->end_time = microtime(true);
    	
        if(!$this->forceText)
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
        else
        {
            
            include nsdg_path."template_clean.php";
        }
    }
    
    function print_r_tree($data)
    {
        // capture the output of print_r
        $out = print_r($data, true);
    
        // replace something like '[element] => <newline> (' with <a href="javascript:toggleDisplay('...');">...</a><div id="..." style="display: none;">
        $out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe',"'\\1<a href=\"javascript:toggleDisplay(\''.(\$id = substr(md5(rand().'\\0'), 0, 7)).'\');\" class=\"dbg_link\">\\2</a><div id=\"'.\$id.'\" style=\"display: none;\">'", $out);
    
        // replace ')' on its own on a new line (surrounded by whitespace is ok) with '</div>
        $out = preg_replace('/^\s*\)\s*$/m', '</div>', $out);
    
        // print the javascript function toggleDisplay() and then the transformed output
        return '<script language="Javascript">function toggleDisplay(id) { document.getElementById(id).style.display = (document.getElementById(id).style.display == "block") ? "none" : "block"; }</script>'."\n$out";
    }
}
?>