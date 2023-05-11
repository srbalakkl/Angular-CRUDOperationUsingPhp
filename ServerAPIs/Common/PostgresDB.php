<?php

namespace Common;
use Exception;
require_once ('MyConfig.php');

class PostgresDB
{
  private string $host;
  private int $port;
  private string $dbname;
  private string $username;
  private string $password;
//  private string $persistent;

  private mixed $dbConnect;
  private mixed $result;
  private mixed $error;

  public function __construct()
  {
//    var_dump("I'm alive........... on pdb");
    //$DB = "", $Host = "localhost", $PgPort = 5432, $User = "Anonymous", $pass = "Anonymous", $persist = 1
    if (extension_loaded("pgsql")) {
      $this->host = MyConfig::pgHost;
      $this->port = MyConfig::pgPort;
      $this->dbname = MyConfig::pgDbName;
      $this->username = MyConfig::pgUser;
      $this->password = MyConfig::pgPassword;
//      $this->persistent = MyConfig::pgPersistent;
      $this->Connect();
    } else {
      echo "Web application server (apache) should be configured for PostgresSQL. Extension pgsql not found.";
      die();
    }
  }

  function Connect(): void
  {
    $connect = "host=" . $this->host . " port=" . $this->port . " dbname=" . $this->dbname . " user=" . $this->username;
    if (!empty($this->password)) {
      $connect .= " password=" . $this->password;
    }
    $this->dbConnect = pg_connect($connect);
    if (!$this->dbConnect)
      $this->error = "cannot connect to database " . $this->dbname;
  }

  /**
   * @throws Exception
   */
  function Query($sql, array $params = array()): mixed
  {
    pg_send_query_params($this->dbConnect, $sql, $params);
    $this->result = pg_get_result($this->dbConnect);
    $this->error = pg_result_error($this->result);

    if (!is_string($this->error)) {
      throw new Exception($this->error);
    }
    return $this->result;
  }

  /**
   * @throws Exception
   */
  function FetchAll($assoc = PGSQL_ASSOC): array
  {
    if (!$this->error) {
      $arr = pg_fetch_all($this->result, $assoc);
      return (!$arr) ? [] : $arr;
    } else {
      throw new Exception($this->error);
    }
  }

  function Commit(): void
  {
    pg_query($this->dbConnect,"commit");
  }

  function Begin(): void
  {
    pg_query($this->dbConnect, "begin");
  }

  function RollBack(): void
  {
    pg_query($this->dbConnect, "Rollback");
  }

  function DBClose(): void
  {
    pg_close($this->dbConnect);
  }

  function Options(): string
  {
    return pg_options($this->dbConnect);
  }

  function Status(): int
  {
    return pg_connection_status($this->dbConnect);
  }


}
