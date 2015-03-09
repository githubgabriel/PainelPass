<?

class painelPass {

    static $tabela = "db_passwords";

    private function getSelect() {
        $sql = "select * from ".self::$tabela." order by id asc";
        return $sql;
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
                $saida .= "<td class='tac'>".$aw["id"]."</td>";
                $saida .= "<td class='tac'>".$aw["categoria"]."</td>";
                $saida .= "<td>".$aw["tipo"]."</td>";
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