<?

class painelPass {

    static $tabela = "db_passwords";

    static $categoria,$tipo,$website,$url,$login,$senha,$descricao;


    private function getFiltrosSession() {
        $ss = "";
        if($_SESSION["filtro_tipo"] or $_SESSION["filtro_categoria"] or $_SESSION["filtro_string"]) {
            $ss .= " where ";
            if($_SESSION["filtro_tipo"]) {
                $ss .= " tipo = '".$_SESSION["filtro_tipo"]."' and";
            }
            if($_SESSION["filtro_categoria"]) {
                $ss .= " categoria = '".$_SESSION["filtro_categoria"]."' and";
            }
            if($_SESSION["filtro_string"]) {
                $ss .= " website LIKE '%".$_SESSION["filtro_string"]."%' or";
                $ss .= " login LIKE '%".$_SESSION["filtro_string"]."%' or";
                $ss .= " senha LIKE '%".$_SESSION["filtro_string"]."%' or";
                $ss .= " descricao LIKE '%".$_SESSION["filtro_string"]."%' or";
                $ss .= " tipo LIKE '%".$_SESSION["filtro_string"]."%' or";
                $ss .= " categoria LIKE '%".$_SESSION["filtro_string"]."%' or";
                $ss .= " url LIKE '%".$_SESSION["filtro_string"]."%' and";
            }
            $ss = substr($ss, 0, -3);
        }
        return $ss;
    }
    private function getSelect() {
        $ff = self::getFiltrosSession();
        $sql = "select * from ".self::$tabela." $ff order by id desc";
        return $sql;
    }
    private function getInsert() {
        $sql = "insert into ".self::$tabela." (categoria,tipo,website,url,login,senha,descricao)";
        $sql .= " values ('".self::$categoria."','".self::$tipo."','".self::$website."','".self::$url."','".self::$login."','".self::$senha."','".self::$descricao."') ";
        return $sql;
    }

    private function getSelectGroupBy($type) {
        $sql = "select * from ".self::$tabela." group by $type";
        return $sql;
    }

    public function save() {
        $sql = self::getInsert();
        if(conexao::query($sql)) {
            return "Registrado com sucesso!";
        } else {
            return "Erro ao registrar!";
        }
    }

    public function getInputSelect($type,$index) {
        $sql = self::getSelectGroupBy($type);
        $re = conexao::query($sql);
        $num = conexao::num_rows($re);
        $saida = "<option value=''> Todos </option>";
        if($num and $type) {
            for ($i = 0; $i < $num; $i++) {
                $aw = conexao::fetch_array($re);
                if($aw[$type] == $index) { $chk = "selected"; } else { $chk = ""; }
                $saida .= "<option value='".$aw[$type]."' $chk>";
                $saida .= "".$aw[$type]."";
                $saida .= "</option>";
            }
        }
        return $saida;
    }

    public function getTable() {
        $sql = self::getSelect();
        $re = conexao::query($sql);
        $num = conexao::num_rows($re);
        if($num) {
            $saida = "";
            for ($i = 0; $i < $num; $i++) {
                $saida .= "<tr>";
                $aw = conexao::fetch_array($re);
                $saida .= "<td class='tac' id='id'>".$aw["id"]."</td>";
                $saida .= "<td class='tac'>".$aw["categoria"]."</td>";
                $saida .= "<td class='tac'>".$aw["tipo"]."</td>";
                $saida .= "<td>".$aw["website"]."</td>";
                $saida .= "<td>".$aw["url"]."</td>";
                $saida .= "<td class='tac'>".$aw["login"]."</td>";
                $saida .= "<td class='tac' id='pass'>".$aw["senha"]."</td>";
                $saida .= "<td>".$aw["descricao"]."</td>";
                $saida .= "</tr>";
            }
        } else { $saida = "Nenhum registro."; }
        return $saida;
    }





}