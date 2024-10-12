<?php

class Datatables
{

    public function getQuery($conn, $query, $where, $isWhere, $cari)
    {
        // Ambil data yang di ketik user pada textbox pencarian
        $search = htmlspecialchars($_POST['search']['value']);
        // Ambil data limit per page
        $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
        // Ambil data start
        $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}");
        // cari array data dari database
        $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";
        // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_field = $_POST['order'][0]['column'];
        // Untuk menentukan order by "ASC" atau "DESC"
        $order_ascdesc = $_POST['order'][0]['dir'];
        $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

        if ($where != null) {
            $setWhere = array();
            foreach ($where as $key => $value) {
                $setWhere[] = $key . "='" . $value . "'";
            }
            $fwhere = implode(' AND ', $setWhere);

            if (!empty($iswhere)) {
                $sql = $conn->prepare($query . " WHERE  $iswhere AND " . $fwhere);
                $sql->execute();
            } else {
                $sql = $conn->prepare($query . " WHERE " . $fwhere);
                $sql->execute();
            }
            $sql_count = $sql->rowCount();

            if (!empty($iswhere)) {
                $sql_data = $conn->prepare($query . " WHERE $iswhere AND " . $fwhere . " AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
                $sql_data->execute();
            } else {
                $sql_data = $conn->prepare($query . " WHERE " . $fwhere . " AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
                $sql_data->execute();
            }

            if (isset($search)) {
                if (!empty($iswhere)) {
                    $sql_cari = $conn->prepare($query . " WHERE $iswhere AND " . $fwhere . " AND (" . $cari . ")");
                    $sql_cari->execute();
                } else {
                    $sql_cari = $conn->prepare($query . " WHERE " . $fwhere . " AND (" . $cari . ")");
                    $sql_cari->execute();
                }
                $sql_filter_count = $sql_cari->rowCount();
            } else {
                if (!empty($iswhere)) {
                    $sql_filter = $conn->prepare($query . " WHERE $iswhere AND " . $fwhere);
                    $sql_filter->execute();
                } else {
                    $sql_filter = $conn->prepare($query . " WHERE " . $fwhere);
                    $sql_filter->execute();
                }
                $sql_filter_count = $sql_filter->rowCount();
            }
            $data = $sql_data->fetchAll();
        } else {
            if (!empty($iswhere)) {
                $sql = $conn->prepare($query . " WHERE  $iswhere ");
                $sql->execute();
            } else {
                $sql = $conn->prepare($query);
                $sql->execute();
            }
            $sql_count = $sql->rowCount();

            if (!empty($iswhere)) {
                $sql_data = $conn->prepare($query . " WHERE $iswhere AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
                $sql_data->execute();
            } else {
                $sql_data = $conn->prepare($query . " WHERE (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
                $sql_data->execute();
            }

            if (isset($search)) {
                if (!empty($iswhere)) {
                    $sql_cari = $conn->prepare($query . " WHERE $iswhere AND (" . $cari . ")");
                    $sql_cari->execute();
                } else {
                    $sql_cari = $conn->prepare($query . " WHERE (" . $cari . ")");
                    $sql_cari->execute();
                }
                $sql_filter_count = $sql_cari->rowCount();
            } else {
                if (!empty($iswhere)) {
                    $sql_filter = $conn->prepare($query . " WHERE $iswhere");
                    $sql_filter->execute();
                } else {
                    $sql_filter = $conn->prepare($query);
                    $sql_filter->execute();
                }
                $sql_filter_count = $sql_filter->rowCount();
            }

            $data = $sql_data->fetchAll();
        }
        $callback = array(
            'draw' => $_POST['draw'], // Ini dari datatablenya
            'recordsTotal' => $sql_count,
            'recordsFiltered' => $sql_filter_count,
            'data' => $data
        );
        return json_encode($callback); // Convert array $callback ke json
    }
}