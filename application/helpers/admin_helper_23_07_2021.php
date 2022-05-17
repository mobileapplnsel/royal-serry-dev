<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('redirectPreviousPage')) {
    function redirectPreviousPage()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: http://' . $_SERVER['SERVER_NAME']);
        }

        exit;
    }
}

function fillCombo($table, $value, $text, $selected, $condition, $order, $class, $name, $id, $is_disable = '')
{
    $msg     = '';
    $str     = '';
    $disable = '';
    $ci      = &get_instance();
    $ci->load->database();
    $fetch = "`" . $value . "`,`" . $text . "`";
    $ci->db->select($fetch);
    $ci->db->from($table);
    if ($condition != '') {
        $ci->db->where($condition);
    }
    $ci->db->order_by($order, 'ASC');
    $query = $ci->db->get();
    if ($is_disable == 1) {
        $disable = 'disabled';
    }

    //echo $ci->db->last_query(); die;
    $data = $query->result_array();
    if (count($data) > 0) {
        $msg .= "<select name='" . $name . "' id='" . $id . "' class='" . $class . "' $disable >";
        $msg .= '<option value="">Select ' . ucwords(str_replace(array('_','[]'), ' ', $name)) . '</option>';
        foreach ($data as $resKey => $resValue) {
            if ($selected == $resValue[$value]) {
                $str = 'selected';
            } else {
                $str = '';
            }
            $msg .= '<option value="' . $resValue[$value] . '" ' . $str . '>' . $resValue[$text] . '';
            $msg .= '</option>';
        }
        $msg .= '</select>';
    }
    return $msg;
}


function getSLNo($module)
{
    $value2 = '';
    $value  = '';
    $ci     = &get_instance();
    $ci->load->database();
    $ql = $ci->db->select('prefix')->from('module_prefix')->where('module_id = "' . $module . '"', null, false)->get();
    //echo $ci->db->last_query(); die;
    $data   = $ql->result_array();
    $prefix = $data[0]['prefix'];
    switch ($module) {
        case '1':
            $query  = $ci->db->query("SELECT id AS result FROM quotation_master ORDER BY id DESC LIMIT 1");
            $result = $query->result_array();
            if (count($result) > 0) {
                $value2       = $result[0]['result'];
                $value2       = $value2 + 1; //Incrementing numeric part
                $value2       = $prefix . "/" . date('Y') . "/" . sprintf('%03s', $value2); //concatenating incremented value
                return $value = $value2;
            } else {
                $value2       = $prefix . "/" . date('Y') . "/001"; //concatenating incremented value
                return $value = $value2;
            }
            break;
        case '2':
            $query  = $ci->db->query("SELECT id AS result FROM shipment_master ORDER BY id DESC LIMIT 1");
            $result = $query->result_array();
            if (count($result) > 0) {
                $value2       = $result['result'];
                $value2       = $value2 + 1; //Incrementing numeric part
                $value2       = $prefix . "/" . date('Y') . "/" . sprintf('%03s', $value2); //concatenating incremented value
                return $value = $value2;
            } else {
                $value2       = $prefix . "/" . date('Y') . "/001"; //concatenating incremented value
                return $value = $value2;
            }
            break;
        default:
            $value2       = "RS/" . date('Y') . "/001"; //concatenating incremented value
            return $value = $value2;

    }
}


/*if ( ! function_exists('get_seo_single_page_info'))
{
function get_seo_single_page_info($id)
{
$ci =& get_instance();
$ci->load->database();

$where = ['id' => $id];
//SELECT QUERY
$ci->db->select('*');
$ci->db->from('seo_details');
$ci->db->where($where);

$query = $ci->db->get();

$row = $query->num_rows();
if($row > 0)
{
$row = $query->result();
return $row;
}
exit;
}
}*/
