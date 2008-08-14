<?php


class RoxModelBase extends RoxComponentBase
{
    /**
     * normally the $dao should be injected.
     * If it's not, this function creates a new one out of the blue..
     */
    protected function get_dao()
    {
        if (!$dbconfig = PVars::getObj('config_rdbms')) {
            throw new PException('DB config error!');
        }
        return PDB::get($dbconfig->dsn, $dbconfig->user, $dbconfig->password);
    }
    
    
    protected function getDao() {
        return $this->dao;
    }
    
    
    /**
     * This method fetches a bunch of rows from the database.
     * It has some funny mechanics, which you can usually just ignore.
     *
     * @param string $query_string
     * @param array $keynames
     *   - this will trigger the funny mechanics which sort the results into a hierarchic structure
     * @return array of rows (as objects)
     */
    public function bulkLookup($query_string, $keynames = false)
    {
        $rows = array();
        if (!is_array($keynames)) {
            $keynames = array($keynames);
        }
        try {
            $sql_result = $this->dao->query($query_string);
        } catch (PException $e) {
            echo '<pre>'; print_r($e); echo '</pre>';
            $sql_result = false;
            // die ('SQL Error');
        }
        if (!$sql_result) {
            // sql problem
            echo '<div>sql error</div>';
        } else while ($row = $sql_result->fetch(PDB::FETCH_OBJ)) {
            $insertion_point = &$rows;
            $i=0;
            while (true) {
                $keyname = $keynames[$i];
                ++$i;
                if (!$keyname) {
                    $insertion_point[] = $row;
                    break;
                }
                if (!isset($row->$keyname)) {
                    $insertion_point[] = $row;
                    break;
                }
                if ($i >= count($keynames)) {
                    $insertion_point[$row->$keyname] = $row;
                    break;
                }
                if (!isset($insertion_point[$row->$keyname])) {
                    $insertion_point[$row->$keyname] = array();
                }
                $insertion_point = &$insertion_point[$row->$keyname];
            }
            /*
            if ($keyname && isset($row->$keyname)) {
                $rows[$row->$keyname] = $row;
            } else {
                $rows[] = $row;
            }
            */
        }
        return $rows;
    }
    
    
    /**
     * This is the same as the above bulkLookup,
     * but the rows are associative arrays instead of objects.
     *
     * @param unknown_type $query_string
     * @return array of rows (as associative arrays)
     */
    public function bulkLookup_assoc($query_string)
    {
        $rows = array();
        if (!$sql_result = $this->dao->query($query_string)) {
            // sql problem
        } else while ($row = $sql_result->fetch(PDB::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    
    public function singleLookup($query_string)
    {
        if (!$sql_result = $this->dao->query($query_string)) {
            // sql problem
            return false;
        } else if (!$row = $sql_result->fetch(PDB::FETCH_OBJ)) {
            // nothing found
            return false;
        } else {
            return $row;
        }
    }
    
        
    public function singleLookup_assoc($query_string)
    {
        if (!$sql_result = $this->dao->query($query_string)) {
            // sql problem
            return false;
        } else if (!$row = $sql_result->fetch(PDB::FETCH_ASSOC)) {
            // nothing found
            return false;
        } else {
            return $row;
        }
    }
}


?>