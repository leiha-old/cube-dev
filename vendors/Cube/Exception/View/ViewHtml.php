<?php

namespace Cube\Exception\View;

use Cube\Cube\View\Behavior\ViewableBehavior;

class ViewHtml
    implements ViewableBehavior
{
    use ViewTrait;

    /**
     * @return string
     */
    public function render()
    {
        $traces = $this->renderTraces();
        return $this->renderCss()
        .'<div id="lia-error">'
            .'<br/>'.$this->renderLastTrace()
            .'<br/>'.$traces
        .'</div>'
            ;
    }

    protected function renderCss()
    {
        $id       = 'div#lia-error';
        $idTraces = $id.' '.$id.'-traces';
        $idTracesFunction = $idTraces.'-function-args';
        return
            "<style type=\"text/css\" media=\"all\">

                $id {
                    width:650px;
                }

                $id, $id * {
                    font-size: 12px;
                }

                $id span {
                    font-weight: bold;
                }

                $idTraces table {
                    border          : 1px solid black;
                    border-collapse : collapse;
                }

                $idTraces table th {
                    border          : 1px solid black;
                    text-align      : left;
                    padding         : 10px 5px;
                }

                $idTraces table tr.lia-error-title {
                   #background-color: whitesmoke;
                }

                $idTraces table.lia-error-trace-item:first-child {
                    margin-top: 0px;
                }

                $idTraces table.lia-error-trace-item {
                    margin-top: 5px;
                    width: 100%;
                }

                $idTraces table td {
                    border          : 1px solid black;
                    padding         : 10px 5px;
                }

                $idTraces table .align-center {
                    text-align      : center;
                }

                $idTraces table .align-right {
                    text-align      : right;
                }

                $idTracesFunction table,
                    $idTracesFunction table td,
                    $idTracesFunction table th {
                        border     : none;
                        font-size  : 95%;
                        font-style : italic;
                        #color      : darkolivegreen;
                }

                $idTracesFunction table th {
                    width : 30%;
                    color : #000;
                }

            </style>"
            ;
    }

    protected function reflexion() {

    }

    /**
     * @return string
     */
    protected function renderLastTrace()
    {
        $head =
            '<thead>'
            .'<tr class="lia-error-title">'
            .'<th colspan="5" style="color: red;">'
               .'Exception
                <span style="color: green;">'.get_class($this->exception).'<span>'
            .'</th>'
            .'</tr>'
            .'</thead>'
        ;

        $body =
            '<tbody>'
            .'<tr>'
            .'<th style="width:7%;text-align:center;">File</th>'
            .'<td class="align-center" style="padding-right: 5px;">'.$this->exception->getLine().'</td>'
            .'<td style="padding:10px 10px;">'.$this->exception->getFile().'</td>'
            .'</tr>'
            .'<tr>'
            .'<td colspan="3" style="padding: 15px 20px;">
                        <span>Message</span><br/><br/>'.$this->exception->getLog()
            .'</td>'
            .'</tr>'
            .'</tbody>'
        ;

        return
            '<div id="lia-error-traces">
                <table style="width: 100%">'.$head.$body.'</table>
            </div>'
            ;
    }

    /**
     * @return string
     */
    public function renderTraces()
    {
        $traces = $this->exception->getTraces();
        if(!count($traces)) {
            return '';
        }

        $body  = '';
        $count = count($traces);
        foreach($traces as $trace)
        {
            $body .=
                '<table class="lia-error-trace-item">
                    <tbody>'.$this->renderTrace($count--, $trace).'</tbody>
                </table>'
            ;
        }

        return
            '<div id="lia-error-traces">
                <table style="width: 100%;">
                    <tr  class="lia-error-title">
                        <th>BackTraces</th>
                    </tr>
                     <tr>
                        <td style="padding: 5px;">'.$body.'</td>
                    </tr>
                </table>
            </div>'
            ;
    }

    /**
     * @param $counter
     * @param array $trace
     * @return string
     */
    protected function renderTrace($counter, array $trace = array())
    {
        $function = $trace['function'];
        if(isset($trace['class'])) {
            $function = ($trace['type' ] == '::'
                    ? '<span style="color:darkslateblue;">STATIC</span> '
                    : ''
                )
                .$trace['class'].'::'.$function;
        }

        if(isset($trace['file'])) {
            $function = $function.'<br/>'
                ."<span style=\"float:right;color:black;font-size: 95%;font-weight:normal;\">
                    $trace[file] : $trace[line]
                    </span>"
                ;
        }

        $row = '';$rowspan = 1;
        if(isset($trace['args']) && count($trace['args'])) {
            $rowspan++;
            $row .=
                '<tr>'
                .'<td colspan=1 style="padding: 5px;">'
                .$this->renderTraceArgs($trace['args'])
                .'</td>'
                .'</tr>'
            ;
        }

        $style = "text-align:center;width: 9%;color:darkolivegreen;font-weight:bold;padding: 10px 5px;";
        return "
            <tr>
                <td rowspan=$rowspan style=\"$style;\">
                    $counter
                </td>
                <td style=\"$style\">$function</td>
            </tr>
            ".$row
        ;
    }

    /**
     * @param array $args
     * @return string
     */
    protected function renderTraceArgs(array $args) {

        $body = '';
        foreach($args as $name => $arg){
//            $body .= "
//                <tr>
//                    <th>$name</th>
//                    <td><pre>".(isset($arg['value']) ? print_r($arg['value'], true) : '')."</pre></td>
//                </tr>"
//            ;
        }

        return
            '<div id="lia-error-traces-function-args">
                <table style="width: 100%;">
                    '.$body.'
                </table>
            </div>'
            ;
    }
}