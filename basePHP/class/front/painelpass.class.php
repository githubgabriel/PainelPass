<?

class painelPass {

    static $tabela = "db_passwords";

    private function getSelect() {
        $sql = "select * from ".self::$tabela." order by id asc";
        return $sql;
    }

    public function getInputSelect($type,$index) {
        $sql = self::getSelect();
        $re = conexao::query($sql);
        $num = conexao::num_rows($re);
        $saida = "<option value=''> Nenhum </option>";
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