<?php
global $dbg;
?>
<html>
    <head>
        <title>NukeDebugger Output</title>
        <style type="text/css">
            
            body{
                margin:10px;
                background: #196bcf;
                padding:0px;
            }
            
            
            .content {
                font:       bold 12px Trebuchet MS, Arial, Verdana;
                padding:    10px;
                color:      #000;
                
            }
            
            .group{
                margin-top:10px;
                border-radius: 5px;
            }
            .group>h3{
                padding-left: 15px;
                padding-top:15px;
                padding-bottom:15px;
                margin:0px;
            }
            
            .group > div{
                padding:15px 15px;
            }
            
            .line {
                border-radius: 5px 5px 0 0;
                text-shadow: 2px 2px 2px rgba(150, 150, 150, 0.8);
                -webkit-box-shadow: 4px 4px 10px 0px rgba(0, 0, 0, 0.8);
                -moz-box-shadow:    4px 4px 10px 0px rgba(0, 0, 0, 0.8);
                box-shadow:         4px 4px 10px 0px rgba(0, 0, 0, 0.8);
                background: rgba(70,133,49,1);
                background: -moz-linear-gradient(top, rgba(70,133,49,1) 0%, rgba(131,228,27,1) 100%);
                background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(70,133,49,1)), color-stop(100%, rgba(131,228,27,1)));
                background: -webkit-linear-gradient(top, rgba(70,133,49,1) 0%, rgba(131,228,27,1) 100%);
                background: -o-linear-gradient(top, rgba(70,133,49,1) 0%, rgba(131,228,27,1) 100%);
                background: -ms-linear-gradient(top, rgba(70,133,49,1) 0%, rgba(131,228,27,1) 100%);
                background: linear-gradient(to bottom, rgba(70,133,49,1) 0%, rgba(131,228,27,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#468531', endColorstr='#83e41b', GradientType=0 );
                color:      #fff;
                font-size:  14px;
                border:     solid 1px #ccc;
                padding:    5px;
                margin:     10px 0px 0px  0px;
            }
            
            .code {
                border-radius: 0 0 5px 5px;
                -webkit-box-shadow: 4px 4px 10px 0px rgba(0, 0, 0, 0.8);
                -moz-box-shadow:    4px 4px 10px 0px rgba(0, 0, 0, 0.8);
                box-shadow:         4px 4px 10px 0px rgba(0, 0, 0, 0.8);
                background: #000;
                color: #fff;
                border:     solid 1px #ccc;
                padding:  0px 5px 5px 5px;
                margin:     0px 0px 0px 0px;
            }
            
            .code a{
                color: #196bcf;;
            }
            
            .code a:hover{
                cursor:pointer;
            }
            
            .group{
                background-color:rgba(255,255,255,0.5);
            }
            
            .dbg_link{
                color:white;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="/helpers/NukeDebugger/nsdbg.js"></script>
    </head>
    <body>
        <div class="content">
            <div class="header">
                <div class="line">
                    Controller:<?php echo $dbg->controller; ?><br />
                    Action:<?php echo $dbg->action; ?><br />
                    <br />
                    DBG Enabled at <br />
                    file: <?php echo $dbg->enable_backtrace[1]['file'];?><br />
                    and line: <?php echo $dbg->enable_backtrace[1]['line'];?><br />
                    <br />
                    Execution time: <?php echo $dbg->end_time - $dbg->start_time; ?><br />
                    
                </div>
            </div> 
            <?php
            if($dbg->data_sql){
            ?>
            <div class="group sql">
            <h3>SQL Queries (<?php echo count($dbg->data_sql);?>)</h3>
                <?php
                foreach($dbg->data_sql as $k=>$entry)
                {
                    ?>
                    <div class="entry">
                        <div class="backtrace line">
                            <?php
                            $trace = $entry["backtrace"][0];
                            ?>
                            <?php if($entry['description']!=""){ ?>
                            Desc : <?php echo $entry['description'];?><br />
                            <?php } ?>
                            File : <?php echo($trace['file']);?><br />
                            Line : <?php echo($trace['line']);?>
                        </div>
                        <div class="code">
                            <?php echo($entry["data"]);?>
                        </div>
                    </div>
                    <?php
                }
            ?>
            </div>
            <?php
            }
            
            if($dbg->data_text){
            ?>
            <div class="group text">
            <h3>Text (<?php echo count($dbg->data_text);?>)</h3>
                <?php
                foreach($dbg->data_text as $k=>$entry)
                {
                    ?>
                    <div class="entry">
                        <div class="backtrace line">
                            <?php
                            $trace = $entry["backtrace"][0];
                            ?>
                            <?php if($entry['description']!=""){ ?>
                            Desc : <?php echo $entry['description'];?><br />
                            <?php } ?>
                            File : <?php echo($trace['file']);?><br />
                            Line : <?php echo($trace['line']);?>
                        </div>
                        <div class="code">
                            <?php echo($entry["data"]);?>
                        </div>
                    </div>
                    <?php
                }
            ?>
            </div>
            <?php
            }
            
            if($dbg->data_array){
            ?>
            <div class="group array">
            <h3>Arrays (<?php echo count($dbg->data_array);?>)</h3>
                <?php
                foreach($dbg->data_array as $k=>$entry)
                {
                    ?>
                    <div class="entry">
                        <div class="backtrace line">
                            <?php
                            $trace = $entry["backtrace"][0];
                            ?>
                            <?php if($entry['description']!=""){ ?>
                            Desc : <?php echo $entry['description'];?><br />
                            <?php } ?>
                            File : <?php echo($trace['file']);?><br />
                            Line : <?php echo($trace['line']);?>
                        </div>
                        <div class="code">
                            <pre><?php 
                                echo print_r_tree($entry["data"]);
                            ?>
                            </pre>
                        </div>
                    </div>
                    <?php
                }
            ?>
            </div>
            <?php
            }
            ?>
        </div>
    </body>
</html>