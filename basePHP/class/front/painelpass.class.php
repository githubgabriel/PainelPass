<?

class painelPass {

    static $tabela = "db_passwords";

    private function getFiltrosSession() {
        $ss = "";
        if($_SESSION["filtro_tipo"] or $_SESSION["filtro_categoria"]) {
            $ss .= " where ";
            if($_SESSION["filtro_tipo"]) {
                $ss .= " tipo = '".$_SESSION["filtro_tipo"]."' and";
            }
            if($_SESSION["filtro_categoria"]) {
                $ss .= " categoria = '".$_SESSION["filtro_categoria"]."' and";
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
    private function getSelectGroupBy($type) {
        $sql = "select * from ".self::$tabela." group by $type";
        return $sql;
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