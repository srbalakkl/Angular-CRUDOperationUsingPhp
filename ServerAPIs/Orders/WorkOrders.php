<?php

namespace Orders;

include_once('C:\PhpstormProjects\Angular-CRUDOperationUsingPhp\ServerAPIs\Common\PostgresDB.php');

use Common\PostgresDB;

class WorkOrders
{
  public function saveOrder(object $data): array
  {
    $retVal['message'] = ['Saved Successfully'];
    $contractor_name = $data->contractor_name ?? null;
    $wo_number = $data->wo_number ?? null;
    $wo_date = $data->wo_date ?? null;
    $wo_desc = $data->wo_desc ?? null;
    $id = $data->id ?? null;

    $db = new PostgresDB();
    try {
      $db->Begin();
      if (is_null($id)) {
        $sql = "INSERT INTO cms.workorders(contractor_name, wo_number, wo_date, wo_desc)
                VALUES ($1,$2,$3,$4)
                RETURNING id";
        $db->Query($sql, [$contractor_name, $wo_number, $wo_date, $wo_desc]);
      } else {
        $sql = "UPDATE cms.workorders
                SET contractor_name = $1,
                    wo_number       = $2,
                    wo_date         = $3,
                    wo_desc         = $4
                WHERE id = $5";
        $db->Query($sql, [$contractor_name, $wo_number, $wo_date, $wo_desc, $id]);
      }
      $db->Commit();
    } catch (\Exception $e) {
      $db->RollBack();
      $retVal['message'] = 'err' . $e->getMessage();
    }
    $db->DBClose();
    return $retVal;
  }
}
