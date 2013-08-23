<?php 

class Computador_model extends CI_Model {
    private $tabla = 'computador';
    private $tabla_ubi = 'ubicacion';
    private $tabla_estado = 'estado_componente';
    private $tabla_com_tipo = 'computador_tipo';
    private $tabla_usu = 'usuario';
    private $tabla_dom = 'dominio';
    private $tabla_red = 'red';
    private $tabla_so = 'sistema_operativo';
    private $tabla_so_tipo = 'sistema_tipo';

    //conexion monitor
    private $tabla_con_monitor = 'computador_monitor';
	private $tabla_mon = 'monitor';

    //conexion impresora
    private $tabla_con_impresora = 'computador_impresora';
    private $tabla_imp = 'impresora';

    //conexion dispositivo
    private $tabla_con_dispositivo = 'computador_dispositivo';
    private $tabla_disp = 'dispositivo';

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Guarda datos de computador
    function save($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //guarda conexion con monitor
    function save_monitor($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_con_monitor), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //guarda conexion con impresora
    function save_impresora($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_con_impresora), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    //guarda conexion con dispositivo
    function save_dispositivo($datos) {
        $guarda = $this->db->insert($this->db->dbprefix($this->tabla_con_dispositivo), $datos);
        if ($guarda) {
            return $this->db->insert_id();
        }else{
            return $guarda;
        }
    }

    function delete_monitor($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_con_monitor));
    }

    function delete_impresora($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_con_impresora));
    }

    function delete_dispositivo($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->db->dbprefix($this->tabla_con_dispositivo));
    }

    //Traer computador
    function get($id = FALSE) {
        $where = '1';
        if ($id) {
            $where = " ".$this->db->dbprefix($this->tabla).".id = ".$id;
        }
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla).".id,
                ".$this->db->dbprefix($this->tabla).".nombre AS nombre_computador,
                ".$this->db->dbprefix($this->tabla).".fabricante,
                ".$this->db->dbprefix($this->tabla).".modelo,
                ".$this->db->dbprefix($this->tabla).".fecha_modificacion,
                ".$this->db->dbprefix($this->tabla).".comentarios,
                ".$this->db->dbprefix($this->tabla).".n_serie,
                ".$this->db->dbprefix($this->tabla).".n_activo,
                ".$this->db->dbprefix($this->tabla).".id_estado,
                ".$this->db->dbprefix($this->tabla).".id_dominio,
                ".$this->db->dbprefix($this->tabla).".id_red,
                ".$this->db->dbprefix($this->tabla).".id_SO,
                ".$this->db->dbprefix($this->tabla).".id_tipo,
                ".$this->db->dbprefix($this->tabla_ubi).".nombre AS ubicacion,
                ".$this->db->dbprefix($this->tabla_ubi).".id AS idubicacion,
                ".$this->db->dbprefix($this->tabla_estado).".nombre AS estado,
                ".$this->db->dbprefix($this->tabla_com_tipo).".nombre AS com_tipo,
                ".$this->db->dbprefix($this->tabla_usu).".id AS idusuario,
                CONCAT(".$this->db->dbprefix($this->tabla_usu).".nombre, ' ', ".$this->db->dbprefix($this->tabla_usu).".apellido) AS nombre_usuario,
                ".$this->db->dbprefix($this->tabla_dom).".nombre AS dominio,
                ".$this->db->dbprefix($this->tabla_red).".nombre AS red,
                ".$this->db->dbprefix($this->tabla_so).".nombre AS sistema_operativo,
                ".$this->db->dbprefix($this->tabla_so).".id_tipo_sistema,
                ".$this->db->dbprefix($this->tabla_so).".version,
                ".$this->db->dbprefix($this->tabla_so_tipo).".nombre AS tipo_so

                FROM ".$this->db->dbprefix($this->tabla)." 

                LEFT JOIN (".$this->db->dbprefix($this->tabla_so).")
                ON (".$this->db->dbprefix($this->tabla_so).".id = ".$this->db->dbprefix($this->tabla).".id_SO)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_so_tipo).")
                ON (".$this->db->dbprefix($this->tabla_so_tipo).".id = ".$this->db->dbprefix($this->tabla_so).".id_tipo_sistema)

                LEFT JOIN(".$this->db->dbprefix($this->tabla_ubi).")
                ON(".$this->db->dbprefix($this->tabla_ubi).".id = ".$this->db->dbprefix($this->tabla).".id_ubicacion)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_dom).")
                ON (".$this->db->dbprefix($this->tabla_dom).".id = ".$this->db->dbprefix($this->tabla).".id_dominio)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_usu).")
                ON (".$this->db->dbprefix($this->tabla_usu).".id = ".$this->db->dbprefix($this->tabla).".id_usuario)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_com_tipo).")
                ON (".$this->db->dbprefix($this->tabla_com_tipo).".id = ".$this->db->dbprefix($this->tabla).".id_tipo)

                LEFT JOIN (".$this->db->dbprefix($this->tabla_estado).")
                ON(".$this->db->dbprefix($this->tabla_estado).".id = ".$this->db->dbprefix($this->tabla).".id_estado)

                LEFT JOIN( ".$this->db->dbprefix($this->tabla_red).")
                ON(".$this->db->dbprefix($this->tabla_red).".id = ".$this->db->dbprefix($this->tabla).".id_red)
                WHERE ".$where."
        ");
        if ($query->num_rows() > 0){
            if($id){
                return $query->row();
            }else{
                return $query->result();
            }            
        }else{
            return FALSE;
        }
    }

    //Traer tipos
    function get_tipos() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_com_tipo));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Traer so
    function get_so() {
        $query = $this->db->get($this->db->dbprefix($this->tabla_so));
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Trae computador segun parametros de $data
    function get_datos($data) {
        $this->db->where($data);
        $query = $this->db->get($this->db->dbprefix($this->tabla));
        if ($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

    //Trae computador segun parametros de $data
    function get_monitor($id_computador) {
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla_con_monitor).".id,
                ".$this->db->dbprefix($this->tabla_con_monitor).".id_monitor,
                ".$this->db->dbprefix($this->tabla_mon).".nombre,
                ".$this->db->dbprefix($this->tabla_mon).".n_serie,
                ".$this->db->dbprefix($this->tabla_mon).".modelo,
                ".$this->db->dbprefix($this->tabla_mon).".fabricante

                FROM ".$this->db->dbprefix($this->tabla_con_monitor)." 

                LEFT JOIN(".$this->db->dbprefix($this->tabla).", ".$this->db->dbprefix($this->tabla_mon).")
                ON(
                ".$this->db->dbprefix($this->tabla).".id = ".$this->db->dbprefix($this->tabla_con_monitor).".id_computador AND
                ".$this->db->dbprefix($this->tabla_mon).".id = ".$this->db->dbprefix($this->tabla_con_monitor).".id_monitor
                )

                WHERE ".$this->db->dbprefix($this->tabla_con_monitor).".id_computador = ".$id_computador);
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function get_impresora($id_computador) {
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla_con_impresora).".id,
                ".$this->db->dbprefix($this->tabla_con_impresora).".id_impresora,
                ".$this->db->dbprefix($this->tabla_imp).".nombre,
                ".$this->db->dbprefix($this->tabla_imp).".n_serie,
                ".$this->db->dbprefix($this->tabla_imp).".modelo,
                ".$this->db->dbprefix($this->tabla_imp).".fabricante

                FROM ".$this->db->dbprefix($this->tabla_con_impresora)." 

                LEFT JOIN(".$this->db->dbprefix($this->tabla).", ".$this->db->dbprefix($this->tabla_imp).")
                ON(
                ".$this->db->dbprefix($this->tabla).".id = ".$this->db->dbprefix($this->tabla_con_impresora).".id_computador AND
                ".$this->db->dbprefix($this->tabla_imp).".id = ".$this->db->dbprefix($this->tabla_con_impresora).".id_impresora
                )

                WHERE ".$this->db->dbprefix($this->tabla_con_impresora).".id_computador = ".$id_computador);
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function get_dispositivo($id_computador) {
        $query = $this->db->query("SELECT 
                ".$this->db->dbprefix($this->tabla_con_dispositivo).".id,
                ".$this->db->dbprefix($this->tabla_con_dispositivo).".id_dispositivo,
                ".$this->db->dbprefix($this->tabla_disp).".nombre,
                ".$this->db->dbprefix($this->tabla_disp).".n_serie,
                ".$this->db->dbprefix($this->tabla_disp).".modelo,
                ".$this->db->dbprefix($this->tabla_disp).".fabricante

                FROM ".$this->db->dbprefix($this->tabla_con_dispositivo)." 

                LEFT JOIN(".$this->db->dbprefix($this->tabla).", ".$this->db->dbprefix($this->tabla_disp).")
                ON(
                ".$this->db->dbprefix($this->tabla).".id = ".$this->db->dbprefix($this->tabla_con_dispositivo).".id_computador AND
                ".$this->db->dbprefix($this->tabla_disp).".id = ".$this->db->dbprefix($this->tabla_con_dispositivo).".id_dispositivo
                )

                WHERE ".$this->db->dbprefix($this->tabla_con_dispositivo).".id_computador = ".$id_computador);
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function buscar($valor){
    	$query = $this->db->query("SELECT id, nombre FROM ".$this->db->dbprefix($this->tabla)." WHERE nombre LIKE '%".$valor."%'");
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    //Elimina un computador
    function delete($id_computador) {
        $this->db->where('id', $id_computador);
        $this->db->delete($this->db->dbprefix($this->tabla));
    }

    //Actualiza los datos del computador
    function update($id_computador, $datos) {
        $this->db->where('id', $id_computador);
        return $this->db->update($this->db->dbprefix($this->tabla), $datos);
    }
}


