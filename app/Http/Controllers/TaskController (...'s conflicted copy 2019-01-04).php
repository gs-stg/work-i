<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Mail\MailA;
use Illuminate\Support\Facades\Mail;
use App\Usuarios;
date_default_timezone_set("Europe/Madrid");   

class TaskController extends Controller
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('SYSTEM_GUEST') == null) {
            Session::put('SYSTEM_GUEST', false);
        }
        if (Session::get('link_type') == null) {
            Session::put('link_type', '');
        }
        
        if (isset(Session::get('permisos')['menu_task'])) {
            $users = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
            $offices = DB::select("SELECT * FROM `t_oficinas`  WHERE `t_oficinas`.`idt_oficinas` != 1 ORDER BY `t_oficinas`.`t_oficinasNombre` ASC");
            $deparment = DB::select("SELECT *, sha1(md5(`t_department`.`idt_department`)) as idt_department FROM `t_department` ORDER BY `t_department`.`t_departmentName` ASC");
            $team = array();
            foreach ($users as $u) {
                $u_deparment = array('id_dp' => '', 'name_dp' => '');
                if ($u -> t_department_idt_department != '') {
                    $u_deparment = DB::select("SELECT * FROM `t_department` WHERE `t_department`.`idt_department` = ?", [$u -> t_department_idt_department]);
                    $u_deparment = array('id_dp' =>  sha1(md5($u_deparment[0] -> idt_department)), 'name_dp' => $u_deparment[0] -> t_departmentName);
                }
                $u -> department = $u_deparment;
                $team[] = $u; 
            }
            $data = array(
                'team' => $team,
                'mode' => 'GeneralTask',
                'offices' => $offices,
                'deparments' => $deparment,
                'SYSTEM_GUEST' => Session::get('SYSTEM_GUEST'),
                'SYSTEM_LINK' => Session::get('link_type')
            );
            return view('task.viewTask') -> with($data);
        }
        return redirect('/login/');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMeeting()
    {
        
        if (Session::get('SYSTEM_GUEST') == null) {
            Session::put('SYSTEM_GUEST', false);
           
        }
        if (Session::get('link_type') == null) {
            Session::put('link_type', '');
        }
        if (isset(Session::get('permisos')['menu_task'])) {
            $users = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
            $offices = DB::select("SELECT * FROM `t_oficinas`  WHERE `t_oficinas`.`idt_oficinas` != 1 ORDER BY `t_oficinas`.`t_oficinasNombre` ASC");
            $deparment = DB::select("SELECT *, sha1(md5(`t_department`.`idt_department`)) as idt_department FROM `t_department` ORDER BY `t_department`.`t_departmentName` ASC");
            $team = array();
            foreach ($users as $u) {
                $u_deparment = array('id_dp' => '', 'name_dp' => '');
                if ($u -> t_department_idt_department != '') {
                    $u_deparment = DB::select("SELECT * FROM `t_department` WHERE `t_department`.`idt_department` = ?", [$u -> t_department_idt_department]);
                    $u_deparment = array('id_dp' =>  sha1(md5($u_deparment[0] -> idt_department)), 'name_dp' => $u_deparment[0] -> t_departmentName);
                }
                $u -> department = $u_deparment;
                $team[] = $u; 
            }
            $SYSTEM_GUEST = false;

            $data = array(
                'team' => $team,
                'mode' => 'Meeting',
                'offices' => $offices,
                'deparments' => $deparment,
                'SYSTEM_GUEST' => Session::get('SYSTEM_GUEST'),
                'SYSTEM_LINK' => Session::get('link_type')
            );
            return view('task.viewTask') -> with($data);
        }
        return redirect('/login/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProject()
    {
        
        if (Session::get('SYSTEM_GUEST') == null) {
            Session::put('SYSTEM_GUEST', false);
           
        }
        if (Session::get('link_type') == null) {
            Session::put('link_type', '');
        }
        if (isset(Session::get('permisos')['menu_task'])) {
            $users = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
            $offices = DB::select("SELECT * FROM `t_oficinas`  WHERE `t_oficinas`.`idt_oficinas` != 1 ORDER BY `t_oficinas`.`t_oficinasNombre` ASC");
            $deparment = DB::select("SELECT *, sha1(md5(`t_department`.`idt_department`)) as idt_department FROM `t_department` ORDER BY `t_department`.`t_departmentName` ASC");
            $team = array();
            foreach ($users as $u) {
                $u_deparment = array('id_dp' => '', 'name_dp' => '');
                if ($u -> t_department_idt_department != '') {
                    $u_deparment = DB::select("SELECT * FROM `t_department` WHERE `t_department`.`idt_department` = ?", [$u -> t_department_idt_department]);
                    $u_deparment = array('id_dp' =>  sha1(md5($u_deparment[0] -> idt_department)), 'name_dp' => $u_deparment[0] -> t_departmentName);
                }
                $u -> department = $u_deparment;
                $team[] = $u; 
            }
            $SYSTEM_GUEST = false;

            $data = array(
                'team' => $team,
                'mode' => 'Project',
                'offices' => $offices,
                'deparments' => $deparment,
                'SYSTEM_GUEST' => Session::get('SYSTEM_GUEST'),
                'SYSTEM_LINK' => Session::get('link_type')
            );
            return view('task.viewTask') -> with($data);
        }
        return redirect('/login/');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function link($link)
    {
        //return Session::all();
        //Session::flush();
        $error = true;
        $task_type = array();
        $task_father = DB::select("SELECT * FROM `t_generalTask`  WHERE  `t_generalTask`.`t_generalTask_link` = ? ", [$link]);
        if (count($task_father) > 0) {
            $task_type[] = array('Type' => $task_father[0] -> t_generalTaskType, 'Task' => $task_father[0]);
            Session::put('link_type', 'father');
            $error = false;
        } else {
            $task_son = DB::select("SELECT * FROM `t_task`  WHERE `t_task`.`t_task_link`  = ? ", [$link]);
            if (count($task_son) > 0) {
                $task_type[] = array('Type' => 'Sub', 'Task' => $task_son[0]);
                Session::put('link_type', 'son');
                $error = false;
            }
        }

        if ($error) {
            
            return redirect('/login/');
        }


        $user = Usuarios::where('t_usuariosType', 'SYSTEM_GUEST')->first();
        $oficina = DB::table('t_oficinas')->where('idt_oficinas', $user -> t_oficinas_idt_oficinas)->first();


      

        $permisos = (object) array(
            "menu_task" => "menu_task"
        );

        Session::put('user', $user);
        Session::put('oficina', $oficina);
        Session::put('mode_system', '');
        Session::put('link', $link);
        Session::put('SYSTEM_GUEST', true);
       
       
        $team = (object) array();
        $offices = DB::select("SELECT * FROM `t_oficinas`  WHERE `t_oficinas`.`idt_oficinas` = 1 ORDER BY `t_oficinas`.`t_oficinasNombre` ASC");
        $deparment = DB::select("SELECT *, sha1(md5(`t_department`.`idt_department`)) as idt_department FROM `t_department` ORDER BY `t_department`.`t_departmentName` ASC");
       

        
        if (count($task_type) > 0) {
            if ($task_type[0]['Type'] == 'Meeting') { 
                Session::put('permisos', array('menu_meeting' => 'menu_meeting'));
                $data = array(
                    'team' => $team,
                    'mode' => 'Meeting',
                    'offices' => $offices,
                    'deparments' => $deparment,
                    'SYSTEM_GUEST' => true,
                    'SYSTEM_LINK' => Session::get('link_type')
                );
            } elseif ($task_type[0]['Type'] == 'Project') {
                Session::put('permisos', array('menu_note' => 'menu_note'));
                $data = array(
                    'team' => $team,
                    'mode' => 'Project',
                    'offices' => $offices,
                    'deparments' => $deparment,
                    'SYSTEM_GUEST' => true,
                    'SYSTEM_LINK' => Session::get('link_type')
                );
            } else {
                Session::put('permisos', array('menu_task' => 'menu_task'));
                $data = array(
                    'team' => $team,
                    'mode' => 'GeneralTask',
                    'offices' => $offices,
                    'deparments' => $deparment,
                    'SYSTEM_GUEST' => Session::get('SYSTEM_GUEST'),
                    'SYSTEM_LINK' => Session::get('link_type')
                );
            }
            return view('task.viewTask') -> with($data);
        }
        
        return redirect('/');
        return crypt(md5(microtime()), 'mhfgestoriasampablo');
    }

    /**
     * Start Session
     *
     * @return string $link
     */
    function generateTaskLink()
    {
        $link = crypt(md5(microtime()), 'mhfgestoriasampablo');
        $link = str_replace('/', '', $link);
        $link = str_replace('.', '', $link);
        return $link;
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function addTaskA(Request $request)
    {
        //return $request;
        if (isset(Session::get('user') -> idt_usuarios)) {
            $t_generalTaskDueDate = null;
            $t_generalTaskDueDateEnd = null;
            $t_generalTaskDocRec = null;
            $t_generalTaskLibroCuaderno = null;
            $t_generalTask_idt_generalTask = null;

            if ($request -> whereIAm['mode'] == 'Meeting' || ($request -> whereIAm['isMobile'] != '')) {
                $t_generalTaskDueDate = date('Y-m-d H:00:s');
                $t_generalTaskDueDateEnd = date('Y-m-d H:00:s', strtotime('1 hour'));
            }

            if ($request -> whereIAm['mode'] == 'Project') {
                $t_generalTaskDocRec = 'Documental';
                $t_generalTaskLibroCuaderno = 'Cuaderno';
            }
            
            if (isset($request -> whereIAm['father_father'])) {
                $task_father = DB::select("SELECT * FROM `t_generalTask` WHERE sha1(md5(idt_generalTask)) = ? ", [$request -> whereIAm['father_father']]);
                $t_generalTask_idt_generalTask = $task_father[0] -> idt_generalTask;
            }
            $id = DB::table('t_generalTask') -> insertGetId(
                [
                't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                't_generalTaskUsuarioName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
                't_generalTaskDateCreated' => date('Y-m-d H:i:s'), 
                't_oficinas_idt_oficinas' => Session::get('user') -> t_oficinas_idt_oficinas,
                't_generalTaskOfficeName' => Session::get('oficina') -> t_oficinasNombre,
                't_generalTaskType' => $request -> whereIAm['mode'],
                't_generalTaskLocation' => Session::get('oficina') -> t_oficinasNombre,
                't_generalTaskDueDate' => $t_generalTaskDueDate,
                't_generalTaskDueDateEnd' => $t_generalTaskDueDateEnd,
                't_generalTask_link' => $this -> generateTaskLink(),
                't_generalTaskDocRec' => $t_generalTaskDocRec,
                't_generalTaskLibroCuaderno' => $t_generalTaskLibroCuaderno,
                't_generalTask_idt_generalTask' => $t_generalTask_idt_generalTask
                ]
            );

            // $id_2 = DB::table('t_taskAssigned') -> insertGetId(
            //     [
            //     't_generalTask_idt_generalTask' => $id, 
            //     't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
            //     't_taskAssignedUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
            //     't_taskAssignedType' => 'Realiza',
            //     't_taskAssignedDate' => date('Y-m-d H:i:s')
            //     ]
            // );
            $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_generalTask_idt_generalTask` = ? ", [$id]);
            $task = DB::table('t_generalTask') -> where('idt_generalTask', $id)->first();
            $task -> can_edit =  true;
            return response() -> json([ 'task' => $task, 'taskAssigned' => $task_assigned, 'taskAssignedDefault' => Session::get('user') -> idt_usuarios, 'id' => sha1(md5($id))]);
            return sha1(md5($id));
        }
    }
    
    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function getDocuments(Request $request)
    {
        //return $request;
        if (isset(Session::get('user') -> idt_usuarios)) {
           
            $d = array();
            $mode = 'son';
            if ($request -> whereIAm['taskSon'] == '0') {
                $mode = 'father';
                $id = $request -> whereIAm['taskFather'];
                $documents = DB::select("SELECT (sha1(md5(`t_file`.`idt_file`))) as `id`, `t_file`.`t_fileName`, `t_file`.`t_fileFormat`, `t_file`.`t_fileUrl`, `t_file_has_t_task`.t_file_has_t_taskPointer FROM `t_file_has_t_task`, `t_file` WHERE sha1(md5(`t_generalTask_idt_generalTask`)) = ? AND  `t_file`.`idt_file` = `t_file_has_t_task`.`t_file_idt_file` ORDER BY `t_file`.`t_fileName` ASC", [$request -> whereIAm['taskFather']]);
            } else {
                
                $id = $request -> whereIAm['taskSon'];
                $documents = DB::select("SELECT (sha1(md5(`t_file`.`idt_file`))) as `id`, `t_file`.`t_fileName`, `t_file`.`t_fileFormat`, `t_file`.`t_fileUrl`, `t_file_has_t_task`.t_file_has_t_taskPointer FROM `t_file_has_t_task`, `t_file` WHERE sha1(md5(`t_task_idt_task`)) = ? AND  `t_file`.`idt_file` = `t_file_has_t_task`.`t_file_idt_file` ORDER BY `t_file`.`t_fileName` ASC", [$request -> whereIAm['taskSon']]);
            }
            

            if (count($documents)>0) {
                foreach ($documents as $doc) {
                    $doc -> t_fileUrl = str_replace("\\", "/", $doc -> t_fileUrl);
                    if (Session::get('SYSTEM_GUEST') == null) {
                        //$doc -> t_file_has_t_taskPointer = 1;
                    } else {
                        $doc -> t_file_has_t_taskPointer = 1;
                    }
                    $doc -> file_name =  pathinfo($doc -> t_fileName, PATHINFO_FILENAME);
                    $d[] = $doc;
                    
                }
            }
            
            return response() -> json([ 'documents' => $d, 'mode' => $mode, 'id' => $id]);
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function editDocumentsName(Request $request)
    {
        $file = DB::select("SELECT * FROM `t_file`  where sha1(md5(`t_file`.`idt_file`))  = ? ", [$request -> id]);
        //$affected = DB::update('DELETE FROM `t_file` WHERE sha1(md5(`t_file`.`idt_file`)) = ?', [$request -> id]);
        //$affected = DB::update('UPDATE `t_mention` SET `t_mentionUserReadIt` = 1 WHERE sha1(md5(`t_mention`.`t_generalTask_idt_generalTask`)) = ? AND `t_mention`.`userWhomMention` = ?', [$request -> id, Session::get('user') -> idt_usuarios]);
        $old_name =  $file[0] -> t_fileUrl;
        $format = $file[0] -> t_fileFormat;
        $name = $request -> name.'.'.$format;
        $new_name = $request -> name.'_'.time().'.'.$format;
        $new_path_name = 'uploads/'.$new_name;
        $rename = rename($old_name, $new_path_name);
        
        if ($rename) {
            $affected = DB::update('UPDATE `t_file` SET t_fileName = ?, t_fileUrl = ? WHERE idt_file = ?', [$name, $new_path_name, $file[0] -> idt_file]);
            return $affected;
        }

        return $file[0] -> idt_file;
    }






    /**
     * Start Session
     *
     * @param array $p 
     * 
     * @return array
     */
    function getUserRolTask($p)
    {
        $rol = (object) array('create' => false, 'realiza' => false, 'valida' => false, 'copia' => false);
        $user = Session::get('user') -> idt_usuarios;
        if ($p -> mode == 'father') {
            $documents = DB::select("", [$request -> whereIAm['taskSon']]);
            
        }

        if ($p -> mode == 'son') {

        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function deleteFileTask(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $file = DB::select("SELECT * FROM `t_file` WHERE sha1(md5(`t_file`.`idt_file`)) = ? ", [$request -> id]);
            $affected = DB::update('DELETE FROM `t_file_has_t_task` WHERE sha1(md5(`t_file_has_t_task`.`t_file_idt_file`)) = ?', [$request -> id]);
            $affected_2 = DB::update('DELETE FROM `t_file` WHERE sha1(md5(`t_file`.`idt_file`)) = ?', [$request -> id]);
            unlink($file[0] -> t_fileUrl);
            return $request.' '.$affected.' '.$affected_2;
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                $filename = '';
                if ($request -> mode == 'son') {
                    $task = DB::select("SELECT * FROM `t_task` WHERE sha1(md5(`t_task`.`idt_task`)) = ? ", [$request -> id]);
                } else {
                    $task = DB::select("SELECT * FROM `t_generalTask` WHERE sha1(md5(idt_generalTask)) = ? ", [$request -> id]);
                }
                foreach ($files as $file) {
                    // Get filename with the extension
                    $filenameWithExt = $file-> getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $ext = pathinfo($filenameWithExt, PATHINFO_EXTENSION);
                    // Get just ext
                    $extension = $file -> getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $file -> move('uploads', $fileNameToStore);

                    $size = $file -> getClientSize();

                    // $path = $request->file('image')->storeAs('/public/upload_files', $fileNameToStore);

                    $id_file = DB::table('t_file') -> insertGetId(['t_fileName' => $filenameWithExt, 't_fileUrl' => $path, 't_fileFormat' =>  $ext, 't_fileSize' => $size]);
                    if ($request -> mode == 'son') {
                        $t_file_has_t_taskId = DB::table('t_file_has_t_task') -> insertGetId(['t_file_idt_file' => $id_file, 't_task_idt_task' => $task[0]  -> idt_task, 't_file_has_t_taskId' => sha1(md5(microtime()))]);
                    }

                    if ($request -> mode == 'father') {
                        $t_file_has_t_taskId = DB::table('t_file_has_t_task') -> insertGetId(['t_file_idt_file' => $id_file, 't_generalTask_idt_generalTask' => $task[0] -> idt_generalTask, 't_file_has_t_taskId' => sha1(md5(microtime()))]);
                        
                        if ($task[0] -> t_generalTaskType == 'Meeting') {
                            $son_task = DB::select("SELECT * FROM t_task WHERE t_task.t_generalTask_idt_generalTask = ? ", [$task[0] -> idt_generalTask]);
                            if (count($son_task) > 0) {
                                foreach ($son_task as $s_t) {
                                    $id_doc = DB::table('t_file_has_t_task') -> insertGetId(
                                        [
                                        't_task_idt_task' => $s_t -> idt_task,
                                        't_file_has_t_taskId' => sha1(md5(microtime())), 
                                        't_file_has_t_taskPointer' => 1,
                                        't_file_idt_file' => $id_file
                                        ]
                                    );
                                }
                            }
                        }
                    }
                }
                return '<script>window.parent.uploadFileSuccess("'.$request -> mode.'");</script>';
            }
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function getNotes(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $notes = array();
            if ($request -> type == 'father') {
                $notes_a = DB::select("SELECT *, (sha1(md5(`t_taskComments`.`idt_taskComments`))) as idt_taskComments  FROM `t_taskComments` WHERE sha1(md5(`t_taskComments`.`t_generalTask_idt_generalTask`)) = ? ", [$request -> id]);
                $notes = array();
                foreach ($notes_a as $n) {
                    $n -> can_edit = false;
                    if (Session::get('user') -> idt_usuarios == $n -> t_usuarios_idt_usuarios) {
                        $n -> can_edit = true;
                    }
                    $notes[] = $n;
                }
            }

            if ($request -> type == 'son') { 
                $notes_a = DB::select("SELECT *, (sha1(md5(`t_taskComments`.`idt_taskComments`))) as idt_taskComments  FROM `t_taskComments` WHERE sha1(md5(`t_taskComments`.`t_task_idt_task`)) = ? ", [$request -> id]);
                $notes = array();
                foreach ($notes_a as $n) {
                    $n -> can_edit = false;
                    if (Session::get('user') -> idt_usuarios == $n -> t_usuarios_idt_usuarios) {
                        $n -> can_edit = true;
                    }
                    $notes[] = $n;
                }
            }
            return response() -> json([ 'notes' => $notes]);
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function addNote(Request $request)
    {
        
        if (isset(Session::get('user') -> idt_usuarios)) {
            if ($request -> type == 'father') {
                $task = DB::select("SELECT * FROM `t_generalTask` WHERE sha1(md5(`idt_generalTask`)) = ? ", [$request -> id]);
                $id_note = DB::table('t_taskComments') -> insertGetId(
                    [
                    't_generalTask_idt_generalTask' => $task[0]  -> idt_generalTask,
                    't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                    't_taskCommentsUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
                    't_taskCommentsDate' => date('Y-m-d H:i:s')
                    ]
                );
                $affected = DB::update('UPDATE `t_mention` SET `t_mentionUserReadIt` = 1 WHERE sha1(md5(`t_mention`.`t_generalTask_idt_generalTask`)) = ? AND `t_mention`.`userWhomMention` = ?', [$request -> id, Session::get('user') -> idt_usuarios]);
            }

            if ($request -> type == 'son') {
                $task = DB::select("SELECT * FROM `t_task` WHERE sha1(md5(`t_task`.`idt_task`)) = ? ", [$request -> id]);
                $id_note = DB::table('t_taskComments') -> insertGetId(
                    [
                    't_task_idt_task' => $task[0]  -> idt_task,
                    't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                    't_taskCommentsUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
                    't_taskCommentsDate' => date('Y-m-d H:i:s')
                    ]
                );
                $affected = DB::update('UPDATE `t_mention` SET `t_mentionUserReadIt` = 1 WHERE sha1(md5(`t_mention`.`t_task_idt_task`)) = ? AND `t_mention`.`userWhomMention` = ?', [$request -> id, Session::get('user') -> idt_usuarios]);
            }
            
                
            return response() -> json([ 'id_note' => sha1(md5($id_note))]);
        }
    }



    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateNote(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $affected = 0;
            $notes = DB::select("SELECT * FROM `t_taskComments` WHERE sha1(md5(`t_taskComments`.`idt_taskComments`)) = ? ", [$request -> id]);
            if (Session::get('user') -> idt_usuarios == $notes[0] -> t_usuarios_idt_usuarios) {
                $affected = DB::update('UPDATE `t_taskComments` SET `t_taskCommentsText` = ? , t_taskCommentsDate = ? WHERE sha1(md5(`t_taskComments`.`idt_taskComments`)) = ?', [$request -> note, date('Y-m-d H:i:s'), $request -> id]);
                $notes[0] -> t_taskCommentsText = $request -> note;
                $this -> controlMention($notes[0]);
            }
                
            
            return response() -> json([ 'affected' => $affected]);
        }
    }

    function controlMention($p)
    {
        //text, id_note, type, id_type
        //Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido
        //Session::get('user') -> idt_usuarios
        
        $text = $p -> t_taskCommentsText;
        $id_mention = '';
        $found = '';
        $affected = DB::update('DELETE  FROM `t_mention`  WHERE `t_mention`.`t_taskComments_idt_taskComments` = ?', [$p -> idt_taskComments]);
     
        
        $text = strtoupper($text);
        $team = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
        foreach ($team as $t) {
            $findme   = '@'.$t -> t_usuariosReferencia;
            $pos = strpos($text, strtoupper($findme));
            if ($pos !== false ) {
                $found .= ' '.$findme;
                $id_mention = DB::table('t_mention') -> insertGetId(
                    [
                    't_generalTask_idt_generalTask' => $p -> t_generalTask_idt_generalTask,
                    't_task_idt_task' => $p -> t_task_idt_task, 
                    'userCreatedMention' => Session::get('user') -> idt_usuarios,
                    'userWhomMention' => $t -> idt_usuarios, 
                    't_mentionDate' => date('Y-m-d H:i:s'), 
                    't_taskComments_idt_taskComments' => $p -> idt_taskComments, 
                    't_mentionUserCName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido,
                    't_mentionUserWName' => $t -> t_usuariosNombre.' '. $t -> t_usuariosApellido
                    ]
                );
            }
        }
        
        return $id_mention;

    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteNote(Request $request)
    {
        $affected = 0;
        if (isset(Session::get('user') -> idt_usuarios)) {
            $notes = DB::select("SELECT * FROM `t_taskComments` WHERE sha1(md5(`t_taskComments`.`idt_taskComments`)) = ? ", [$request -> id]);
            if (Session::get('user') -> idt_usuarios == $notes[0] -> t_usuarios_idt_usuarios) {
                $affected = DB::update('DELETE  FROM `t_mention`  WHERE `t_mention`.`t_taskComments_idt_taskComments` = ?', [$request -> id]);
                $affected = DB::update('DELETE FROM `t_taskComments` WHERE sha1(md5(`t_taskComments`.`idt_taskComments`)) = ?', [$request -> id]);
            }
        }
        return response() -> json([ 'affected' => $affected]);
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function getTask(Request $request)
    {
        //return $request;
        if (isset(Session::get('user') -> idt_usuarios)) {
            
            $task = array();
            $using_link = '';

            if ($request -> whereIAm['listToRefresh'] == 'task' || $request -> whereIAm['listToRefresh'] == 'subTaskListMeeting') {

                if ($request -> whereIAm['active_show'] == 'father') {
                    $task = $this -> getTaskFather($request);
                    
                    if (count($task) > 0) {
                        $task = $this -> ordenTask($task, $request -> whereIAm['active_orden'], $request -> whereIAm['ordenSigno']);
                        return response() -> json(['task' => $task, 'message' => '', 'status' => true, 'whereIAm' => $request -> whereIAm]);
                    }
                }
                
                if ($request -> whereIAm['active_show'] == 'son') {

                    $father_avoid_duplicate = array();

                    if ($request -> whereIAm['active_status'] == 'completed') {
                        $status = "t_generalTaskStatus  ='Completed'";
                    } elseif ($request -> whereIAm['active_status'] == 'all') {
                        $status = "(t_generalTaskStatus != 'Deleted' OR t_generalTaskStatus is null)";
                    } else {
                        $status = "((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null)";
                    }

                    $search = "";
                    if ($request -> whereIAm['search'] != '') {
                        $search = "( t_generalTaskTitle like '%".$request -> whereIAm['search']."%'  OR  t_generalTaskCName LIKE  '%".$request -> whereIAm['search']."%' ) AND";
                    }
                   

                    $using_link = ' sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) = ? ';
                    // if (Session::get('link') !== null) {
                    //     if (Session::get('link_type') == 'father') {
                    //         $using_link = ' `t_generalTask`.`t_generalTask_link`  = \''.Session::get('link').'\' ';
                    //     }
                    // }
                    if ($request -> whereIAm['activeUser'] == 'all') {
                        $using_link = " `t_generalTask`.`t_usuarios_idt_usuarios` IS NOT null ";
                    }
                    
                    if ($request -> whereIAm['follow_mode'] == 'follow') {
                        $taskA = array();
                    } elseif ($request -> whereIAm['mention_mode'] == 'mention') {
                        $taskA = array();
                    } else {
                        $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where  ".$search."  `t_generalTaskType` = 'GeneralTask' AND ".$using_link." AND ".$status."  AND t_generalTask.idt_generalTask NOT IN (SELECT (t_generalTask_idt_generalTask) as idt_generalTask  FROM `t_taskAssigned`  WHERE `t_taskAssigned`.`t_generalTask_idt_generalTask` IS NOT NULL) ", [$request -> whereIAm['activeUser']]);
                    }
                   
                    if (count($taskA) > 0) {
                        foreach ($taskA as $t) {
                            $show_task = true;
                            $task_assigned = array();
                            $expired = false;
                            $can_delete = false;
                            $can_close = true;
                            $mention = false;
                            $find_son = DB::select("SELECT * FROM `t_task` WHERE `t_task`.`t_generalTask_idt_generalTask` = ? AND ((`t_task`.`t_taskStatus` != 'Completed' AND `t_task`.`t_taskStatus` != 'Deleted') OR `t_task`.`t_taskStatus` IS NULL)", [$t -> idt_generalTask]);
                            if (count($find_son) > 0) {
                                $can_close = false;
                            }

                            

                            if ($t -> t_generalTaskDueDate != '') {
                                if ($t -> t_generalTaskDueDate < date('Y-m-d H:i:s')) {
                                    $expired = true;
                                }
                            }

                            if ($t -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                                $can_delete = true;
                            }

                            $find_mention = DB::select("SELECT * FROM `t_mention`  WHERE `t_mention`.`t_generalTask_idt_generalTask` = ?  AND  sha1(md5(`t_mention`.`userWhomMention`)) = ?", [$t -> idt_generalTask, $request -> whereIAm['activeUser']]);
                            if (count($find_mention) > 0) {
                                $mention = true;
                                if ($find_mention[0] -> t_mentionUserReadIt == 1 ) {
                                    $mention = false;
                                    if (!$can_delete) {
                                        $show_task = false;
                                    }
                                }
                            }

                            if ($t->t_generalTaskTitle != '') {
                                $father_avoid_duplicate[$t -> idt_generalTask] = $t -> idt_generalTask;
                                if ($show_task) {
                                    $task[] = array(
                                        'title' => $t->t_generalTaskTitle,
                                        'type' => 'father',
                                        'father' => sha1(md5($t -> idt_generalTask)),
                                        'obj' => $t,
                                        'due_date' => $t -> t_generalTaskDueDate,
                                        'son' => '',
                                        'priority' =>  $t -> t_generalTaskPriorityNumber,
                                        'taskAssigned' => $task_assigned,
                                        'taskAssigned_default_name' => '',
                                        'taskAssigned_default_type' => '',
                                        'taskAssigned_default_me' => true,
                                        'status' => $t -> t_generalTaskStatus,
                                        'repeat' => $t -> t_generalTaskRepeatMode,
                                        'taskDependenceDone' => 1,
                                        'taskDependence' => '67a74306b06d0c01624fe0d0249a570f4d093747',
                                        'customer' => $t -> t_generalTaskCName,
                                        'expired'=> $expired,
                                        'can_delete' =>  $can_delete,
                                        'can_close' => $can_close,
                                        'count_incompleted' => count($find_son),
                                        'follow' => $t -> follow,
                                        'mention' => $mention
                                    );
                                }


                            } else {
                                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE  `t_generalTask`.`t_usuarios_idt_usuarios` = ? AND `t_generalTask`.idt_generalTask = ?', ['Deleted',date('Y-m-d H:i:s'),Session::get('user') -> idt_usuarios,$t -> idt_generalTask]);
           
                            }
                        }
                    }


                    
                   
                    if ($request -> whereIAm['follow_mode'] == 'follow') {
                        $taskA = DB::select("(SELECT *,('1') as follow FROM `t_generalTask`, `t_taskAssigned` WHERE  ".$search."  `t_generalTaskType` = 'GeneralTask'  AND ".$status." AND  `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND sha1(md5(t_generalTask.t_usuarios_idt_usuarios)) = ? AND t_generalTask.idt_generalTask NOT IN (SELECT (t_taskAssigned.t_generalTask_idt_generalTask) as idt_generalTask FROM `t_taskAssigned` WHERE  sha1(md5(t_taskAssigned.t_usuarios_idt_usuarios)) = ? AND t_taskAssigned.t_generalTask_idt_generalTask IS NOT NULL)) UNION (SELECT *,('1') as follow FROM `t_generalTask`, `t_taskAssigned` WHERE `t_generalTaskType` = 'GeneralTask' AND ".$status." AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted' AND t_generalTaskStatus != 'waiting_validation' ) OR t_generalTaskStatus is null) AND `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND sha1(md5(t_generalTask.t_usuarios_idt_usuarios)) = ? AND sha1(md5(t_taskAssigned.t_usuarios_idt_usuarios)) = ? AND t_generalTask.idt_generalTask NOT IN (SELECT (t_taskAssigned.t_generalTask_idt_generalTask) as idt_generalTask FROM `t_taskAssigned` WHERE sha1(md5(t_taskAssigned.t_usuarios_idt_usuarios)) = ? AND t_taskAssigned.t_taskAssignedType != 'Valida'  AND t_taskAssigned.t_generalTask_idt_generalTask IS NOT NULL))",  [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                    } elseif ($request -> whereIAm['mention_mode'] == 'mention') {
                        $taskA = DB::select("SELECT  *,('0') as follow FROM `t_generalTask` WHERE ".$search."  ".$status."  AND  `t_generalTask`.`idt_generalTask` IN  (SELECT (`t_mention`.`t_generalTask_idt_generalTask`) as idt_generalTask FROM `t_mention` WHERE sha1(md5(`t_mention`.`userWhomMention`)) = ? AND  `t_mention`.`t_generalTask_idt_generalTask` IS NOT null)", [ $request -> whereIAm['activeUser']]);
                    } else {
                        $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where  ".$search."  `t_generalTaskType` = 'GeneralTask'  AND ".$status." AND  `t_generalTask`.`idt_generalTask`  IN (SELECT (t_generalTask_idt_generalTask) as idt_generalTask  FROM  t_taskAssigned  WHERE sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ? ) UNION (SELECT  *,('0') as follow FROM `t_generalTask` WHERE ".$search."  ".$status."  AND  `t_generalTask`.`idt_generalTask` IN  (SELECT (`t_mention`.`t_generalTask_idt_generalTask`) as idt_generalTask FROM `t_mention` WHERE sha1(md5(`t_mention`.`userWhomMention`)) = ? AND  `t_mention`.`t_generalTask_idt_generalTask` IS NOT null))", [ $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                    }

                    if ($request -> whereIAm['activeUser'] == 'all') {
                        if ($request -> whereIAm['follow_mode'] == 'follow') {
                            $taskA = DB::select("(SELECT *,('1') as follow FROM `t_generalTask`, `t_taskAssigned` WHERE  ".$search."  `t_generalTaskType` = 'GeneralTask'  AND ".$status." AND  `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND t_generalTask.t_usuarios_idt_usuarios IS NOT NULL AND t_generalTask.idt_generalTask NOT IN (SELECT (t_taskAssigned.t_generalTask_idt_generalTask) as idt_generalTask FROM `t_taskAssigned` WHERE  t_taskAssigned.t_usuarios_idt_usuarios IS NOT NULL AND t_taskAssigned.t_generalTask_idt_generalTask IS NOT NULL)) UNION (SELECT *,('1') as follow FROM `t_generalTask`, `t_taskAssigned` WHERE `t_generalTaskType` = 'GeneralTask' AND ".$status." AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted' AND t_generalTaskStatus != 'waiting_validation' ) OR t_generalTaskStatus is null) AND `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND t_generalTask.t_usuarios_idt_usuarios IS NOT NULL AND t_taskAssigned.t_usuarios_idt_usuarios IS NOT NULL AND t_generalTask.idt_generalTask NOT IN (SELECT (t_taskAssigned.t_generalTask_idt_generalTask) as idt_generalTask FROM `t_taskAssigned` WHERE t_taskAssigned.t_usuarios_idt_usuarios IS NOT NULL AND t_taskAssigned.t_taskAssignedType != 'Valida'  AND t_taskAssigned.t_generalTask_idt_generalTask IS NOT NULL))",  [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                        } elseif ($request -> whereIAm['mention_mode'] == 'mention') {
                            $taskA = DB::select("SELECT  *,('0') as follow FROM `t_generalTask` WHERE ".$search."  ".$status."  AND  `t_generalTask`.`idt_generalTask` IN  (SELECT (`t_mention`.`t_generalTask_idt_generalTask`) as idt_generalTask FROM `t_mention` WHERE `t_mention`.`userWhomMention` IS NOT NULL AND  `t_mention`.`t_generalTask_idt_generalTask` IS NOT null)", [ $request -> whereIAm['activeUser']]);
                        } else {
                            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where  ".$search."  `t_generalTaskType` = 'GeneralTask'  AND ".$status." AND  `t_generalTask`.`idt_generalTask`  IN (SELECT (t_generalTask_idt_generalTask) as idt_generalTask  FROM  t_taskAssigned  WHERE `t_taskAssigned`.`t_usuarios_idt_usuarios` IS NOT NULL ) UNION (SELECT  *,('0') as follow FROM `t_generalTask` WHERE ".$search."  ".$status."  AND  `t_generalTask`.`idt_generalTask` IN  (SELECT (`t_mention`.`t_generalTask_idt_generalTask`) as idt_generalTask FROM `t_mention` WHERE `t_mention`.`userWhomMention` IS NOT NULL AND  `t_mention`.`t_generalTask_idt_generalTask` IS NOT null))", [ $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                        } 
                    }
                    
                    $using_link = ' sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) = ? ';
                    if (Session::get('link') !== null) {
                        $using_link = ' `t_generalTask`.`t_generalTask_link`  = \''.Session::get('link').'\' ';
                        $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where  ".$search."  `t_generalTaskType` = 'GeneralTask'  AND ".$status." AND ".$using_link);
                        $taskAssigned_default_type = 'CC';
                    }
                  
                    if (count($taskA) > 0) {
                        $distinct = array();
                        foreach ($taskA as $t) {
                          

                            $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_generalTask_idt_generalTask` = ? ", [$t -> idt_generalTask]);
                            
                            $show_task = true;
                            if ($request -> whereIAm['follow_mode'] != 'follow') {
                                foreach ($task_assigned as $t_a) {
                                    
                                    if (sha1(md5($t_a -> t_usuarios_idt_usuarios)) == $request -> whereIAm['activeUser']) {
                                    
                                        if ($t_a -> t_taskAssignedType == 'Valida' && $t -> t_generalTaskStatus != 'waiting_validation' && $t -> t_generalTaskStatus != 'Completed' ) {
                                            $show_task = false;
                                        }

                                        if ($t_a -> t_taskAssignedType == 'Realiza' && $t -> t_generalTaskStatus == 'waiting_validation') {
                                            $show_task = false;
                                        }
                                    }

                                }
                            }
                            
                            if (!isset($distinct[$t -> idt_generalTask])) {
                                $distinct[$t -> idt_generalTask] = $t -> idt_generalTask;
                            } else {
                                $show_task = false;
                            }
                            if (!isset($father_avoid_duplicate[$t -> idt_generalTask])) {
                                $father_avoid_duplicate[$t -> idt_generalTask] = $t -> idt_generalTask;
                            } else {
                                $show_task = false;
                            }
                            
                            
                            if ($show_task) {
                                $expired = false;
                                $can_delete = false;
                                $can_close = true;
                                $mention = false;

                                $find_son = DB::select("SELECT * FROM `t_task` WHERE `t_task`.`t_generalTask_idt_generalTask` = ? AND ((`t_task`.`t_taskStatus` != 'Completed' AND `t_task`.`t_taskStatus` != 'Deleted') OR `t_task`.`t_taskStatus` IS NULL)", [$t -> idt_generalTask]);
                                if (count($find_son) > 0) {
                                    $can_close = false;
                                }
                                $taskAssigned_default_name = '';
                                $taskAssigned_default_type = '';
                                if (count($task_assigned) > 0 ) {
                                  
                                } else {
                                    $taskAssigned_default_type = 'CC';
                                }
                                if ($t -> t_usuarios_idt_usuarios != Session::get('user') -> idt_usuarios) {
                                    $taskAssigned_default_me = false;
                                }
                                foreach ($task_assigned as $t_a) {
                                    
                                    if (sha1(md5($t_a -> t_usuarios_idt_usuarios)) == $request -> whereIAm['activeUser']) {
                                        $taskAssigned_default_name = $t_a -> t_taskAssignedUserName;
                                        $taskAssigned_default_type = $t_a -> t_taskAssignedType;
                                        $taskAssigned_default_me = true;
                                        
                                    }
    
                                }
                                

                               
                                if ($t -> t_generalTaskDueDate != '') {
                                    if ($t -> t_generalTaskDueDate < date('Y-m-d H:i:s')) {
                                        $expired = true;
                                    }
                                }

                                if ($t -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                                    $can_delete = true;
                                }

                                $find_mention = DB::select("SELECT * FROM `t_mention`  WHERE `t_mention`.`t_generalTask_idt_generalTask` = ?  AND  sha1(md5(`t_mention`.`userWhomMention`)) = ?  ORDER BY `t_mention`.`t_mentionUserReadIt` ASC", [$t -> idt_generalTask, $request -> whereIAm['activeUser']]);
                                if (count($find_mention) > 0) {
                                    $mention = true;
                                    if ($find_mention[0] -> t_mentionUserReadIt == 1 ) {
                                        $mention = false;
                                        if (!$can_delete && $request -> whereIAm['mention_mode'] != 'mention' && !$taskAssigned_default_me) {
                                            $show_task = false;
                                        }
                                    }
                                    if ($taskAssigned_default_type == 'CC') {
                                        $taskAssigned_default_me = true;
                                    }
                                    
                                    
                                } else {
                                    if ($request -> whereIAm['mention_mode'] == 'mention') {
                                        $show_task = false;
                                    }
                                }

                                if (Session::get('link') !== null) {
                                    $taskAssigned_default_type = 'CC';
                                }
                                

                                if ($show_task) {
                                    if ($t->t_generalTaskTitle != '') {
                                        $task[] = array(
                                            'title' => $t->t_generalTaskTitle,
                                            'type' => 'father',
                                            'father' => sha1(md5($t -> idt_generalTask)),
                                            'obj' => $t,
                                            'due_date' => $t -> t_generalTaskDueDate,
                                            'son' => '',
                                            'priority' =>  $t -> t_generalTaskPriorityNumber,
                                            'taskAssigned' => $task_assigned,
                                            'taskAssigned_default_name' => $taskAssigned_default_name,
                                            'taskAssigned_default_type' => $taskAssigned_default_type,
                                            'taskAssigned_default_me' => $taskAssigned_default_me,
                                            'status' => $t -> t_generalTaskStatus,
                                            'repeat' => $t -> t_generalTaskRepeatMode,
                                            'taskDependenceDone' => 1,
                                            'taskDependence' => '67a74306b06d0c01624fe0d0249a570f4d093747',
                                            'customer' => $t -> t_generalTaskCName,
                                            'expired'=> $expired,
                                            'can_delete' =>  $can_delete,
                                            'can_close' => $can_close,
                                            'count_incompleted' => count($find_son),
                                            'follow' => $t -> follow,
                                            'mention' => $mention
                                        );
                                    } else {
                                        $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE  `t_generalTask`.`t_usuarios_idt_usuarios` = ? AND `t_generalTask`.idt_generalTask = ?', ['Deleted',date('Y-m-d H:i:s'),Session::get('user') -> idt_usuarios,$t -> idt_generalTask]);
                
                                    }
                                }
                            }
                        }
                    }

                    if ($request -> whereIAm['active_status'] == 'completed') {
                        $status = "`t_task`.`t_taskStatus` ='Completed'";
                    } elseif ($request -> whereIAm['active_status'] == 'all') {
                        $status = "( `t_task`.`t_taskStatus` !='Deleted' OR `t_task`.`t_taskStatus` IS null )";
                    } else {
                        $status = "((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed') OR `t_task`.`t_taskStatus` IS null )";
                    }
                    $search = "";
                    if ($request -> whereIAm['search'] != '') {
                        $search = " (t_task.t_taskTitle like '%".$request -> whereIAm['search']."%' OR  t_generalTaskCName LIKE  '%".$request -> whereIAm['search']."%') AND";
                    }

                    if ($request -> whereIAm['follow_mode'] == 'follow') {
                        $taskA = array();
                    } elseif ($request -> whereIAm['mention_mode'] == 'mention') {
                        $taskA = array();
                    } else {
                        $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`,`t_task` WHERE   ".$search."  ".$status."   AND  `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` AND sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) = ? AND `t_task`.`idt_task` NOT IN (SELECT t_taskAssigned.t_task_idt_task as idt_task FROM t_taskAssigned WHERE t_taskAssigned.t_task_idt_task != '')", [$request -> whereIAm['activeUser']]);
                        if ($request -> whereIAm['activeUser'] == 'all') {
                            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`,`t_task` WHERE   ".$search."  ".$status."   AND  `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` AND  `t_generalTask`.`t_usuarios_idt_usuarios` IS NOT NULL AND `t_task`.`idt_task` NOT IN (SELECT t_taskAssigned.t_task_idt_task as idt_task FROM t_taskAssigned WHERE t_taskAssigned.t_task_idt_task != '')", [$request -> whereIAm['activeUser']]);
                        
                        }
                    }
                    
                    if (count($taskA) > 0) {
                        foreach ($taskA as $t) {
                            $task_assigned = array();
                            $show_task = false;
                            $expired = false;
                            $can_delete = false;
                            $mention = false;
                            if ($t -> t_taskDueDate != '') {
                                if ($t -> t_taskDueDate < date('Y-m-d H:i:s')) {
                                    $expired = true;
                                }
                            }

                            if ($t -> t_taskUserCreated == Session::get('user') -> idt_usuarios) {
                                $can_delete = true;
                            }

                            $find_mention = DB::select("SELECT * FROM `t_mention`  WHERE `t_mention`.`t_task_idt_task` = ?  AND  sha1(md5(`t_mention`.`userWhomMention`)) = ?  ORDER BY `t_mention`.`t_mentionUserReadIt` ASC", [$t -> idt_task, $request -> whereIAm['activeUser']]);
                            if (count($find_mention) > 0) {
                                $mention = true;
                                if ($find_mention[0] -> t_mentionUserReadIt == 1 ) {
                                    $mention = false;
                                    if (!$can_delete) {
                                        $show_task = false;
                                    }
                                }
                            }
                            if ($t -> t_taskTitle != '') {
                                if ($show_task) {
                                    $task[] = array(
                                        'title' => $t -> t_taskTitle,
                                        'type' => 'son',
                                        'father' => sha1(md5($t -> idt_generalTask)),
                                        'obj' => $t,
                                        'due_date' => $t -> t_taskDueDate,
                                        'son' => sha1(md5($t -> idt_task)),
                                        'taskAssigned' => $task_assigned,
                                        'taskAssigned_default_name' => '',
                                        'taskAssigned_default_type' => '',
                                        'taskAssigned_default_me' => true,
                                        'priority' => $t -> t_taskPriorityNumber,
                                        'status' => $t -> t_taskStatus,
                                        'repeat' => $t -> t_taskRepeatMode,
                                        'taskDependenceDone' => $t -> t_taskDependenceDone,
                                        'taskDependence' => sha1(md5($t -> t_taskDependence)),
                                        'customer' => $t -> t_generalTaskCName,
                                        'expired'=> $expired,
                                        'can_delete' =>  $can_delete,
                                        'can_close' => true,
                                        'follow' => $t -> follow,
                                        'mention' => $mention
                                    );
                                }
                                
                            } else {
                                $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ?, t_taskChecked = ?, t_taskUserChecked = ?, t_taskUserNameChecked = ?  WHERE `t_task`.`t_taskUserCreated` = ? AND  `t_task`.idt_task = ?', ['Deleted',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'), Session::get('user') -> idt_usuarios, Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, Session::get('user') -> idt_usuarios,$t -> idt_task]);
           
                            }
                        }
                    }

                    
                    if ($request -> whereIAm['follow_mode'] == 'follow') {
                        if ($request -> whereIAm['active_status'] == 'completed') {
                            $status = "`t_task`.`t_taskStatus` ='Completed'";
                        } else {
                            $status = "((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed' AND `t_task`.`t_taskStatus` !='waiting_validation') OR `t_task`.`t_taskStatus` IS null ) ";
                        }
                        $taskA = DB::select("(SELECT *,('1') as follow FROM  `t_generalTask`,`t_task`, `t_taskAssigned` WHERE ".$search."  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND   ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND  sha1(md5(t_task.t_taskUserCreated)) = ? AND t_task.idt_task NOT IN  (SELECT (t_taskAssigned.t_task_idt_task) as idt_task FROM `t_taskAssigned` WHERE sha1(md5(t_taskAssigned.t_usuarios_idt_usuarios)) = ? AND t_taskAssigned.t_task_idt_task IS NOT NULL)) UNION (SELECT *,('1') as follow FROM `t_generalTask`, `t_task`, `t_taskAssigned` WHERE `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` AND  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND  sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ? AND ".$status."AND `t_taskAssigned`.`t_taskAssignedType` = 'Valida')", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                        if ($request -> whereIAm['activeUser'] == 'all') {
                            $taskA = DB::select("(SELECT *,('1') as follow FROM  `t_generalTask`,`t_task`, `t_taskAssigned` WHERE ".$search."  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND   ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND  t_task.t_taskUserCreated IS NOT NULL AND t_task.idt_task NOT IN  (SELECT (t_taskAssigned.t_task_idt_task) as idt_task FROM `t_taskAssigned` WHERE t_taskAssigned.t_usuarios_idt_usuarios IS NOT NULL AND t_taskAssigned.t_task_idt_task IS NOT NULL)) UNION (SELECT *,('1') as follow FROM `t_generalTask`, `t_task`, `t_taskAssigned` WHERE `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` AND  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND  `t_taskAssigned`.`t_usuarios_idt_usuarios` IS NOT NULL AND ".$status."AND `t_taskAssigned`.`t_taskAssignedType` = 'Valida')", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                        }
                    
                    } elseif ($request -> whereIAm['mention_mode'] == 'mention') {
                        $taskA = DB::select("SELECT *,('0') as follow  FROM `t_generalTask`, `t_task` WHERE ".$search."    ".$status."  AND `t_task`.`t_generalTask_idt_generalTask` =  `t_generalTask`.`idt_generalTask` AND `t_task`.`idt_task` IN (SELECT `t_mention`.`t_task_idt_task` as idt_task FROM `t_mention` WHERE `t_mention`.`t_task_idt_task` IS NOT null AND sha1(md5(`t_mention`.`userWhomMention`)) =  ? )", [$request -> whereIAm['activeUser']]);
                        if ($request -> whereIAm['activeUser'] == 'all') {
                            $taskA = DB::select("SELECT *,('0') as follow  FROM `t_generalTask`, `t_task` WHERE ".$search."    ".$status."  AND `t_task`.`t_generalTask_idt_generalTask` =  `t_generalTask`.`idt_generalTask` AND `t_task`.`idt_task` IN (SELECT `t_mention`.`t_task_idt_task` as idt_task FROM `t_mention` WHERE `t_mention`.`t_task_idt_task` IS NOT null AND `t_mention`.`userWhomMention` IS NOT NULL )", [$request -> whereIAm['activeUser']]);
                        }
                    } else {
                        //$taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`,`t_task`, `t_taskAssigned` WHERE  ".$search."  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND   ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ?", [$request -> whereIAm['activeUser']]);
                        $taskA = DB::select("(SELECT *,('0') as follow FROM `t_generalTask`,`t_task` WHERE  ".$search."    ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND `t_task`.idt_task IN (SELECT `t_taskAssigned`.`t_task_idt_task` AS idt_task FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ?)) UNION (SELECT *,('0') as follow  FROM `t_generalTask`, `t_task` WHERE ".$search."    ".$status."  AND `t_task`.`t_generalTask_idt_generalTask` =  `t_generalTask`.`idt_generalTask` AND `t_task`.`idt_task` IN (SELECT `t_mention`.`t_task_idt_task` as idt_task FROM `t_mention` WHERE `t_mention`.`t_task_idt_task` IS NOT null AND sha1(md5(`t_mention`.`userWhomMention`)) =  ? ))", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                        if ($request -> whereIAm['activeUser'] == 'all') {
                            $taskA = DB::select("(SELECT *,('0') as follow FROM `t_generalTask`,`t_task` WHERE  ".$search."    ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND `t_task`.idt_task IN (SELECT `t_taskAssigned`.`t_task_idt_task` AS idt_task FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_usuarios_idt_usuarios` IS NOT NULL )) UNION (SELECT *,('0') as follow  FROM `t_generalTask`, `t_task` WHERE ".$search."    ".$status."  AND `t_task`.`t_generalTask_idt_generalTask` =  `t_generalTask`.`idt_generalTask` AND `t_task`.`idt_task` IN (SELECT `t_mention`.`t_task_idt_task` as idt_task FROM `t_mention` WHERE `t_mention`.`t_task_idt_task` IS NOT null AND `t_mention`.`userWhomMention` IS NOT NULL ))", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
                        }
                    }

                    
                    if (Session::get('link') !== null) {
                        $using_link = ' `t_task`.`t_task_link`  = \''.Session::get('link').'\' ';
                        $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`,`t_task` WHERE  ".$search."    ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND ".$using_link);
                       
                    }
                   
                    //return "SELECT * FROM `t_generalTask`,`t_task`, `t_taskAssigned` WHERE  ".$search."  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND   ".$status." AND `t_task`.`t_taskDependenceDone` = 1 AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = '".$request -> whereIAm['activeUser']."'";
                    
                    if (count($taskA) > 0) {
                        $distinct = array();
                        foreach ($taskA as $t) {
                            // $taskAssigned_default_name = $t -> t_taskAssignedUserName;
                            // $taskAssigned_default_type = $t -> t_taskAssignedType;
                            // $taskAssigned_default_me = true;

                            $taskAssigned_default_name = '';
                            $taskAssigned_default_type = '';
                            $taskAssigned_default_me = true;

                            $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$t -> idt_task]);
                            if ($t -> t_usuarios_idt_usuarios != Session::get('user') -> idt_usuarios) {
                                $taskAssigned_default_me = false;
                            }
                            $show_task = true;
                            if ($request -> whereIAm['follow_mode'] != 'follow') {
                                foreach ($task_assigned as $t_a) {
                                    if (sha1(md5($t_a -> t_usuarios_idt_usuarios)) == $request -> whereIAm['activeUser']) {
                                        if ($t_a -> t_taskAssignedType == 'Valida' && $t -> t_taskStatus != 'waiting_validation' && $t -> t_taskStatus != 'Completed' ) {
                                            $show_task = false;
                                        }

                                        if ($t_a -> t_taskAssignedType == 'Realiza' && $t -> t_taskStatus == 'waiting_validation') {
                                            $show_task = false;
                                        }
                                    }
                                }
                            }
                           
                            if (!isset($distinct[$t -> idt_task])) {
                                $distinct[$t -> idt_task] = $t -> idt_task;
                            } else {
                                $show_task = false;
                            }

                            if ($show_task) {
                                $expired = false;
                                $can_delete = false;
                                $mention = false;
                                if ($t -> t_taskDueDate != '') {
                                    if ($t -> t_taskDueDate < date('Y-m-d H:i:s')) {
                                        $expired = true;
                                    }
                                }
                                if ($t -> t_taskUserCreated == Session::get('user') -> idt_usuarios) {
                                    $can_delete = true;
                                }



                                
                                if (count($task_assigned) > 0 ) {
                                  
                                } else {
                                    $taskAssigned_default_type = 'CC';
                                }
                                if ($t -> t_usuarios_idt_usuarios != Session::get('user') -> idt_usuarios) {
                                    $taskAssigned_default_me = false;
                                }
                                foreach ($task_assigned as $t_a) {
                                    
                                    if (sha1(md5($t_a -> t_usuarios_idt_usuarios)) == $request -> whereIAm['activeUser']) {
                                        $taskAssigned_default_name = $t_a -> t_taskAssignedUserName;
                                        $taskAssigned_default_type = $t_a -> t_taskAssignedType;
                                        $taskAssigned_default_me = true;
                                        
                                    }
    
                                }

                                $find_mention = DB::select("SELECT * FROM `t_mention`  WHERE `t_mention`.`t_task_idt_task` = ?  AND  sha1(md5(`t_mention`.`userWhomMention`)) = ?  ORDER BY `t_mention`.`t_mentionUserReadIt` ASC", [$t -> idt_task, $request -> whereIAm['activeUser']]);
                                if (count($find_mention) > 0) {
                                    $mention = true;
                                    
                                    if ($find_mention[0] -> t_mentionUserReadIt == 1 ) {
                                        $mention = false;
                                        if (!$can_delete && $request -> whereIAm['mention_mode'] != 'mention' && !$taskAssigned_default_me) {
                                            $show_task = false;
                                        }
                                    }
                                    if ($taskAssigned_default_type == 'CC') {
                                        $taskAssigned_default_me = true;
                                    }
                                } else {
                                    if ($request -> whereIAm['mention_mode'] == 'mention') {
                                        $show_task = false;
                                    }
                                }
                                if ($show_task) {
                                    if ($t -> t_taskTitle != '') {
                                        $task[] = array(
                                            'title' => $t -> t_taskTitle,
                                            'type' => 'son',
                                            'father' => sha1(md5($t -> idt_generalTask)),
                                            'obj' => $t,
                                            'due_date' => $t -> t_taskDueDate,
                                            'son' => sha1(md5($t -> idt_task)),
                                            'taskAssigned' => $task_assigned,
                                            'taskAssigned_default_name' => $taskAssigned_default_name,
                                            'taskAssigned_default_type' => $taskAssigned_default_type,
                                            'taskAssigned_default_me' => $taskAssigned_default_me,
                                            'priority' => $t -> t_taskPriorityNumber,
                                            'status' => $t -> t_taskStatus,
                                            'repeat' => $t -> t_taskRepeatMode,
                                            'taskDependenceDone' => $t -> t_taskDependenceDone,
                                            'taskDependence' => sha1(md5($t -> t_taskDependence)),
                                            'customer' => $t -> t_generalTaskCName,
                                            'expired'=> $expired,
                                            'can_delete' =>  $can_delete,
                                            'can_close' => true,
                                            'follow' => $t -> follow,
                                            'mention' => $mention
                                        );
                                    } else {
                                        $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ?, t_taskChecked = ?, t_taskUserChecked = ?, t_taskUserNameChecked = ?  WHERE `t_task`.`t_taskUserCreated` = ? AND  `t_task`.idt_task = ?', ['Deleted',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'), Session::get('user') -> idt_usuarios, Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, Session::get('user') -> idt_usuarios,$t -> idt_task]);
                
                                    }
                                }
                            }
                            
                        }
                    }
                }
                if (count($task) > 0) {
                    
                    $task = $this -> ordenTask($task, $request -> whereIAm['active_orden'], $request -> whereIAm['ordenSigno']);
                    return response() -> json(['task' => $task, 'message' => '', 'status' => true, 'whereIAm' => $request -> whereIAm]);
                }
            }

        
            if ($request -> whereIAm['listToRefresh'] == 'subTaskList') {
                // return $request;
                if ($request -> whereIAm['active_status_son'] == 'completed') {
                    $status = "`t_task`.`t_taskStatus` ='Completed'";
                } else {
                    $status = "((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed') OR `t_task`.`t_taskStatus` IS null )";
                }

                $search = "";
                if ($request -> whereIAm['search'] != '') {
                    $search = " (t_task.t_taskTitle like '%".$request -> whereIAm['search']."%' OR  t_generalTaskCName LIKE  '%".$request -> whereIAm['search']."%') AND";
                }

                $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` , `t_task` where ".$search." sha1(md5(`t_task`.`t_generalTask_idt_generalTask`)) = ? AND ".$status." AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` ORDER BY `t_task`.`idt_task` DESC", [$request -> whereIAm['taskFather']]);
                //$taskA = DB::select("SELECT * FROM `t_generalTask`, `t_taskAssigned`, `t_task` WHERE sha1(md5(`t_task`.`t_generalTask_idt_generalTask`)) = ? AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` AND `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND ( `t_generalTask`.`t_usuarios_idt_usuarios` = ?  OR `t_task`.`t_taskUserCreated` = ? OR `t_taskAssigned`.`t_usuarios_idt_usuarios` = ?)", [$request -> whereIAm['taskFather'], Session::get('user') -> idt_usuarios, Session::get('user') -> idt_usuarios, Session::get('user') -> idt_usuarios]);
                
                if (count($taskA) > 0) {
                    foreach ($taskA as $t) {
                        $taskAssigned_default_name = '';
                        $taskAssigned_default_type = '';
                        $taskAssigned_default_me = true;
                        $me = false;
                        $realiza = false;
                        $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$t -> idt_task]);
                        foreach ($task_assigned as $ta) {
                            if (!$me) {
                                if ($ta -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                                    $taskAssigned_default_name = $ta -> t_taskAssignedUserName;
                                    $taskAssigned_default_type = $ta -> t_taskAssignedType;
                                    $taskAssigned_default_me = true;
                                    $me = true;
                                } else {
                                    if ($ta -> t_taskAssignedType == 'Realiza') {
                                        $taskAssigned_default_name = $ta -> t_taskAssignedUserName;
                                        $taskAssigned_default_type = $ta -> t_taskAssignedType;
                                        $realiza = true;
                                        $taskAssigned_default_me = false;
                                    } else {
                                        if (!$realiza) {
                                            $taskAssigned_default_name = $ta -> t_taskAssignedUserName;
                                            $taskAssigned_default_type = $ta -> t_taskAssignedType;
                                            $taskAssigned_default_me = false;
                                        }
                                    }
                                }
                            }
                        }

                        $expired = false;
                        $can_delete = false;
                        $mention = false;
                        if ($t -> t_taskDueDate != '') {
                            if ($t -> t_taskDueDate < date('Y-m-d H:i:s')) {
                                $expired = true;
                            }
                        }
                        $find_mention = DB::select("SELECT * FROM `t_mention`  WHERE `t_mention`.`t_task_idt_task` = ?  AND  sha1(md5(`t_mention`.`userWhomMention`)) = ?", [$t -> idt_task, $request -> whereIAm['activeUser']]);
                        if (count($find_mention) > 0) {
                            $mention = true;
                        }

                        if ($t -> t_taskTitle != '') {
                            $task[] = array(
                                'title' => $t -> t_taskTitle,
                                'type' => 'son',
                                'father' => sha1(md5($t -> idt_generalTask)),
                                'obj' => $t,
                                'due_date' => $t -> t_taskDueDate,
                                'son' => sha1(md5($t -> idt_task)),
                                'taskAssigned' => $task_assigned,
                                'taskAssigned_default_name' => $taskAssigned_default_name,
                                'taskAssigned_default_type' => $taskAssigned_default_type,
                                'taskAssigned_default_me' => $taskAssigned_default_me,
                                'priority' => $t -> t_taskPriorityNumber,
                                'status' => $t -> t_taskStatus,
                                'repeat' => $t -> t_taskRepeatMode,
                                'taskDependenceDone' => $t -> t_taskDependenceDone,
                                'taskDependence' => sha1(md5($t -> t_taskDependence)),
                                'customer' => $t -> t_generalTaskCName,
                                'expired'=> $expired,
                                'can_delete' =>  $can_delete,
                                'can_close' => true,
                                'follow' => $t -> follow,
                                'mention' => $mention
                            );
                        }
                    }
                }
                if (count($task) > 0) {
                    $task = $this -> ordenTask($task, 'date', '>');
                    return response() -> json(['task' => $task, 'message' => '', 'status' => true, 'whereIAm' => $request -> whereIAm]);
                }
            }

           
            return response() -> json([ 'task' => '', 'message' => '', 'status' => false, 'whereIAm' => $request -> whereIAm]);
            return $request;
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function getTaskFather(Request $request)
    {

        $using_link = '';
        $task = array();
        $using_link = ' sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) = ? ';
        if (Session::get('link') !== null) {
            if (Session::get('link_type') == 'father') {
                $using_link = ' `t_generalTask`.`t_generalTask_link`  = \''.Session::get('link').'\' ';
            }

        }
        if ($request -> whereIAm['activeUser'] == 'all') {
            $using_link = " `t_generalTask`.`t_usuarios_idt_usuarios` IS NOT null ";
        }

        if ($request -> whereIAm['active_status'] == 'completed') {
            $status = "t_generalTaskStatus  ='Completed'";
        } elseif ($request -> whereIAm['active_status'] == 'all') {
            $status = "( t_generalTaskStatus != 'Deleted' OR t_generalTaskStatus is null)";
        } else {
            $status = "((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null)";
        }

        $search = "";
        if ($request -> whereIAm['search'] != '') {
            $search = " (t_generalTaskTitle like '%".$request -> whereIAm['search']."%' OR  t_generalTaskCName LIKE  '%".$request -> whereIAm['search']."%') AND";
        }

        $t_generalTaskDocRec = "";
        if ($request -> whereIAm['doc_rec_mode'] != '') {
            $t_generalTaskDocRec = " t_generalTaskDocRec = '".$request -> whereIAm['doc_rec_mode']."' AND";
        }

        if ($request -> whereIAm['listToRefresh'] == 'subTaskListMeeting') {
            $using_link = ' sha1(md5(t_generalTask_idt_generalTask)) = \''.$request -> whereIAm['taskFather'].'\' ';
        }

        if ($request -> whereIAm['mode'] == 'Meeting') {
            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where  ".$search." `t_generalTaskType` = 'Meeting' AND ".$using_link." AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser']]);
        } elseif ($request -> whereIAm['mode'] == 'Project') {
            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where   ".$t_generalTaskDocRec." ".$search." `t_generalTaskType` = 'Project' AND ".$using_link." AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser']]);
        } else {
            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask` where  ".$search."  `t_generalTaskType` = 'GeneralTask' AND ".$using_link." AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser']]);
        }
        
        
        if (count($taskA) > 0) {
            foreach ($taskA as $t) {

                if ($t->t_generalTaskTitle != '') {
                    $expired = false;
                    $can_delete = false;
                    $show_task = true;
                    if ($t -> t_generalTaskDueDate != '') {
                        if ($t -> t_generalTaskDueDate < date('Y-m-d H:i:s')) {
                            $expired = true;
                        }
                    }

                    if ($t -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                        $can_delete = true;
                    }

                    $taskAssigned_default_type = '';
                    $taskAssigned_default_me = true;
                    if (Session::get('link') !== null) {
                        $taskAssigned_default_type = 'CC';
                        $taskAssigned_default_me = false;
                    }

                    if ($request -> whereIAm['mode'] == 'Project') {
                        if ($request -> whereIAm['doc_rec_mode'] != '') {

                        } else {
                            if ($t -> t_generalTaskDocRec == 'Recordatorio') {
                                if ($t -> t_generalTaskDueDate >= date('Y-m-d 00:00:01') && $t -> t_generalTaskDueDate <= date('Y-m-d 23:59:59')) {

                                } else {
                                    // if ($t -> t_generalTaskDueDate < date('Y-m-d Y-m-d 00:00:01')) {
                                    //     // update due date to next year
                                    //     $new_due_date = date('Y-m-d H:i:s', strtotime('+1 years', strtotime($t -> t_generalTaskDueDate))); 
                                    //     $affected = DB::update('UPDATE `t_generalTask` SET  t_generalTaskDueDate = ? WHERE  `t_generalTask`.idt_generalTask = ?', [$new_due_date,$t -> idt_generalTask]);

                                    // }
                                    $show_task = false;
                                }
                            }
                        }
                        
                    }
                   

                    if ($show_task) {
                        $task[] = array(
                            'title' => $t->t_generalTaskTitle,
                            'type' => 'father',
                            'father' => sha1(md5($t -> idt_generalTask)),
                            'obj' => $t,
                            'due_date' => $t -> t_generalTaskDueDate,
                            'son' => '',
                            'priority' => $t -> t_generalTaskPriorityNumber,
                            'taskAssigned' => '',
                            'taskAssigned_default_name' => '',
                            'taskAssigned_default_type' =>  $taskAssigned_default_type,
                            'taskAssigned_default_me' => $taskAssigned_default_me,
                            'status' => $t -> t_generalTaskStatus,
                            'repeat' => $t -> t_generalTaskRepeatMode,
                            'taskDependenceDone' => 1,
                            'taskDependence' => '67a74306b06d0c01624fe0d0249a570f4d093747',
                            'customer' => $t -> t_generalTaskCName,
                            'expired'=> $expired,
                            'can_delete' =>  $can_delete,
                            'can_close' => true,
                            'follow' => $t -> follow
                        );
                    }
                } else {
                    $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE  `t_generalTask`.`t_usuarios_idt_usuarios` = ? AND `t_generalTask`.idt_generalTask = ?', ['Deleted',date('Y-m-d H:i:s'),Session::get('user') -> idt_usuarios,$t -> idt_generalTask]);

                }
                
            }
        }

        if ($request -> whereIAm['mode'] == 'Meeting') {
            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`, `t_taskAssigned` where  ".$search." `t_generalTaskType` = 'Meeting' AND sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) != ? AND   `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ?  AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
            if ($request -> whereIAm['activeUser'] == 'all') {
                $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`, `t_taskAssigned` where  ".$search." `t_generalTaskType` = 'Meeting' AND `t_generalTask`.`t_usuarios_idt_usuarios` IS NOT NULL AND   `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND  `t_taskAssigned`.`t_usuarios_idt_usuarios` IS NOT NULL  AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
            }
        } elseif ($request -> whereIAm['mode'] == 'Project') {
            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`, `t_taskAssigned` where  ".$search." `t_generalTaskType` = 'Project' AND sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) != ? AND   `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ?  AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
            if ($request -> whereIAm['activeUser'] == 'all') {
                $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`, `t_taskAssigned` where  ".$search." `t_generalTaskType` = 'Project' AND `t_generalTask`.`t_usuarios_idt_usuarios` IS NOT NULL AND   `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND `t_taskAssigned`.`t_usuarios_idt_usuarios` IS NOT NULL  AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
            }
        } else {
            $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`, `t_taskAssigned` where  ".$search."  `t_generalTaskType` = 'GeneralTask' AND sha1(md5(`t_generalTask`.`t_usuarios_idt_usuarios`)) != ? AND  `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND sha1(md5(`t_taskAssigned`.`t_usuarios_idt_usuarios`)) = ?  AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
            if ($request -> whereIAm['activeUser'] == 'all') {
                $taskA = DB::select("SELECT *,('0') as follow FROM `t_generalTask`, `t_taskAssigned` where  ".$search."  `t_generalTaskType` = 'GeneralTask' AND  `t_generalTask`.`t_usuarios_idt_usuarios` IS NOT NULL AND  `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND `t_taskAssigned`.`t_usuarios_idt_usuarios` IS NOT NULL  AND ".$status." ORDER BY `t_generalTask`.`idt_generalTask` DESC", [$request -> whereIAm['activeUser'], $request -> whereIAm['activeUser']]);
            }
        }

        if ($request -> whereIAm['listToRefresh'] == 'subTaskListMeeting') {
            $taskA = array();
        }
        //$taskA = array();
        if (count($taskA) > 0) {
            foreach ($taskA as $t) {
                $expired = false;
                $can_delete = false;
                $show = true;
                if ($t -> t_generalTaskDueDate != '') {
                    if ($t -> t_generalTaskDueDate < date('Y-m-d H:i:s')) {
                        $expired = true;
                    }
                }

                if ($t -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                    $can_delete = true;
                }
               
                if ($request -> whereIAm['doc_rec_mode'] == 'Recordatorio') {
                    if ($t -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                        $show = false;
                    }
                }

                if ($show) {
                    if ($t->t_generalTaskTitle != '') {
                        $task[] = array(
                            'title' => $t->t_generalTaskTitle,
                            'type' => 'father',
                            'father' => sha1(md5($t -> idt_generalTask)),
                            'obj' => $t,
                            'due_date' => $t -> t_generalTaskDueDate,
                            'son' => '',
                            'priority' =>  $t -> t_generalTaskPriorityNumber,
                            'taskAssigned' => '',
                            'taskAssigned_default_name' => '',
                            'taskAssigned_default_type' => '',
                            'taskAssigned_default_me' => true,
                            'status' => $t -> t_generalTaskStatus,
                            'repeat' => $t -> t_generalTaskRepeatMode,
                            'taskDependenceDone' => 1,
                            'taskDependence' => '67a74306b06d0c01624fe0d0249a570f4d093747',
                            'customer' => $t -> t_generalTaskCName,
                            'expired'=> $expired,
                            'can_delete' =>  $can_delete,
                            'can_close' => true,
                            'follow' => $t -> follow
                        );
                    } else {
                        $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE  `t_generalTask`.`t_usuarios_idt_usuarios` = ? AND `t_generalTask`.idt_generalTask = ?', ['Deleted',date('Y-m-d H:i:s'),Session::get('user') -> idt_usuarios,$t -> idt_generalTask]);
    
                    }
                }
                
            }
        }
        return $task;
    }




    public function ordenTask($task, $orden, $c)
    {
        
        if ($orden == 'title') {
            if ($c == '>') {
                usort ($task, function ($a, $b) {
                    return  strtoupper($a['title']) > strtoupper($b['title']);
                });
            } else {
                usort ($task, function ($a, $b) {
                    return  strtoupper($a['title']) < strtoupper($b['title']);
                });
            }
            $t1_temp = array();
            $t2_temp = array();
            foreach ($task as $t) {
                if ($t['title'] == '') {
                    $t2_temp[] = $t;
                } else {
                    $t1_temp[] = $t;
                }
            }
            foreach ($t2_temp as $t) {
                $t1_temp[] = $t;
            }
            $task = $t1_temp;
        }
        
        if ($orden == 'priority') {
            if ($c == '>') {
                usort ($task, function ($a, $b) {
                    return  strtoupper($a['due_date']) > strtoupper($b['due_date']);
                });
            } else {
                usort ($task, function ($a, $b) {
                    return  strtoupper($a['due_date']) < strtoupper($b['due_date']);
                });
            }
            $t1_temp = array();
            $t2_temp = array();
            foreach ($task as $t) {
                if ($t['due_date'] == '') {
                    $t2_temp[] = $t;
                } else {
                    $t1_temp[] = $t;
                }
            }
            foreach ($t2_temp as $t) {
                $t1_temp[] = $t;
            }
            $task = $t1_temp;


            $t1_temp = array();
            $t2_temp = array();
            foreach ($task as $t) {
                if ($t['priority'] != 1) {
                    $t2_temp[] = $t;
                } else {
                    $t1_temp[] = $t;
                }
            }
            foreach ($t2_temp as $t) {
                $t1_temp[] = $t;
            }

            $task = $t1_temp;
        }

        if ($orden == 'type') {
            if ($c == '>') {
                usort ($task, function ($a, $b) {
                    return  strtoupper($a['taskAssigned_default_type']) > strtoupper($b['taskAssigned_default_type']);
                });
            } else {
                usort ($task, function ($a, $b) {
                    return  strtoupper($a['taskAssigned_default_type']) < strtoupper($b['taskAssigned_default_type']);
                });
            }
            $t1_temp = array();
            $t2_temp = array();
            foreach ($task as $t) {
                if ($t['taskAssigned_default_type'] == '') {
                    $t2_temp[] = $t;
                } else {
                    $t1_temp[] = $t;
                }
            }
            foreach ($t2_temp as $t) {
                $t1_temp[] = $t;
            }
            $task = $t1_temp;
        }

        if ($orden == 'date') {
            usort ($task, function ($a, $b) {
                return $a['due_date'] <=> $b['due_date'];
            });
            if ($c == '>') {
                usort ($task, function ($a, $b) {
                    return  $a['due_date'] > $b['due_date'];
                });
            } else {
                usort ($task, function ($a, $b) {
                    return  $a['due_date'] < $b['due_date'];
                });
            }
            $t1_temp = array();
            $t2_temp = array();
            foreach ($task as $t) {
                if ($t['due_date'] == '') {
                    $t2_temp[] = $t;
                } else {
                    $t1_temp[] = $t;
                }
            }
            foreach ($t2_temp as $t) {
                $t1_temp[] = $t;
            }
            $task = $t1_temp;
        }

        return $task;
    }

    
    public function getOneTask(Request $request)
    { 
        //return $request;
        if (isset(Session::get('user') -> idt_usuarios)) {
            $task = array();
            if ($request -> type == 'father') {
                //$task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                $taskA = DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ? ", [$request -> id]);
                if (count($taskA) > 0) {
                    
                    $can_edit = true;
                    $can_delete = false;
                    if ($taskA[0] -> t_usuarios_idt_usuarios != Session::get('user') -> idt_usuarios) {
                        $can_edit = false;
                    }
                    $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ? ", [$request -> id]);
                    
                    // if (!mb_detect_encoding($taskA[0]  -> t_generalTaskCName, 'UTF-8', true)) {
                    //     if ($taskA[0]  -> t_generalTaskCName != '') {
                            $taskA[0]  -> t_generalTaskCName = $this -> Sustituto_Cadena($taskA[0]  -> t_generalTaskCName);
                    //     }
                    //     if ($taskA[0]  -> t_generalTaskCFirstName != '') {
                           $taskA[0]  -> t_generalTaskCFirstName = $this -> Sustituto_Cadena($taskA[0]  -> t_generalTaskCFirstName);
                    //     }
                    // }
                    if ($taskA[0] -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                        $can_delete = true;
                    }
                    $can_close = true;

                    $find_son = DB::select("SELECT * FROM `t_task` WHERE `t_task`.`t_generalTask_idt_generalTask` = ? AND ((`t_task`.`t_taskStatus` != 'Completed' AND `t_task`.`t_taskStatus` != 'Deleted') OR `t_task`.`t_taskStatus` IS NULL)", [$taskA[0] -> idt_generalTask]);
                    if (count($find_son) > 0) {
                        $can_close = false;
                    }
                    if ($can_close) {
                        foreach ($task_assigned as $t_a) {
                            if (Session::get('user') -> idt_usuarios == $t_a -> t_usuarios_idt_usuarios) {
                                if ($t_a -> t_taskAssignedType == 'CC') {
                                    $can_close = false;
                                }
                            }
                        }

                        if ($taskA[0] -> t_usuarios_idt_usuarios != Session::get('user') -> idt_usuarios) {
                           
                            if (count($task_assigned)> 0) {
                                
                            } else {
                                $can_close = false;
                            }
                        }
                    }
                    $system_guest = false;
                    if (Session::get('link') !== null) {
                        $can_close = false;
                        $can_edit = false;
                        $system_guest = true;
                    }

                    $lock = false;
                    if ($taskA[0] -> t_generalTaskLibroCuaderno == 'Libro') {
                        if (Session::get('user') -> idt_usuarios != $taskA[0] -> t_usuarios_idt_usuarios) {
                            // $can_close = false;
                            // $can_edit = false;
                            // $system_guest = true;
                            // $can_delete = false;
                            $lock = true;
                        }
                    }

                    $task = array(
                        'title' => $taskA[0] -> t_generalTaskTitle,
                        'type' => 'father',
                        'father' => sha1(md5($taskA[0] -> idt_generalTask)),
                        'obj' => $taskA[0],
                        'taskAssigned' => $task_assigned,
                        'taskAssignedDefault' => Session::get('user') -> idt_usuarios,
                        'son' => '',
                        'can_edit' => $can_edit,
                        'status' => $taskA[0] -> t_generalTaskStatus,
                        'can_delete' => $can_delete,
                        'repeat' => $taskA[0]-> t_generalTaskRepeatMode,
                        'can_close' => $can_close,
                        'find_son' => count($find_son),
                        'SYSTEM_GUEST' => $system_guest,
                        'lock' => $lock
                    );
                    
                }
            
            }

            if ($request -> type == 'son') {
                $taskA = DB::select("SELECT * FROM `t_generalTask` , `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?  AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` ", [$request -> id]);
                
                if (count($taskA) > 0) {
                    foreach ($taskA as $t) {
                        $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$t -> idt_task]);
                        // if (mb_detect_encoding($t  -> t_generalTaskCName, 'UTF-8', true)) {
                        //     $t  -> t_generalTaskCName = utf8_decode($t  -> t_generalTaskCName);
                        // }
                        // if (mb_detect_encoding($t  -> t_generalTaskCFirstName, 'UTF-8', true)) {
                        //     $t  -> t_generalTaskCFirstName = utf8_decode($t  -> t_generalTaskCFirstName);
                        // }
                        $can_delete = false;
                        if ($taskA[0] -> t_taskUserCreated == Session::get('user') -> idt_usuarios) {
                            $can_delete = true;
                        }

                        $can_close = true;
                        foreach ($task_assigned as $t_a) {
                            if (Session::get('user') -> idt_usuarios == $t_a -> t_usuarios_idt_usuarios) {
                                if ($t_a -> t_taskAssignedType == 'CC') {
                                    $can_close = false;
                                }
                            }
                        }
                        $system_guest = false;
                        if (Session::get('link') !== null) {
                            $can_close = false;
                            $can_edit = false;
                            $system_guest = true;
                        }
                        $task = array(
                            'title' => $t -> t_taskTitle,
                            'type' => 'son',
                            'father' => sha1(md5($t -> idt_generalTask)),
                            'obj' => $t,
                            'taskAssigned' => $task_assigned,
                            'taskAssignedDefault' => Session::get('user') -> idt_usuarios,
                            'son' => sha1(md5($t -> idt_task)),
                            'status' => $t -> t_taskStatus,
                            'taskDependence' => sha1(md5($t -> t_taskDependence)),
                            'can_delete' => $can_delete,
                            'repeat' => $t -> t_taskRepeatMode,
                            'can_close' => $can_close,
                            'SYSTEM_GUEST' => $system_guest,
                            'lock' => false
                        );
                    }
                }
            }


            if (count($task) > 0) {
                return response() -> json(['task' => $task, 'message' => '', 'status' => true]);
            }
            return response() -> json([ 'task' => '', 'message' => '', 'status' => false]);
            return $request;
        }
    }

    public function duplicateRepeatTaskFather($task) 
    {
        
        $new_date = $this -> createFutureDay($task -> t_generalTaskDueDate, $task -> t_generalTaskRepeatMode);
        $t_generalTaskDueDateEnd = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($new_date)));
        $id = DB::table('t_generalTask') -> insertGetId(
            [
            't_usuarios_idt_usuarios' => $task -> t_usuarios_idt_usuarios, 
            't_generalTaskUsuarioName' => $task -> t_generalTaskUsuarioName, 
            't_generalTaskDateCreated' => date('Y-m-d H:i:s'), 
            't_oficinas_idt_oficinas' => $task -> t_oficinas_idt_oficinas,
            't_generalTaskOfficeName' => $task -> t_generalTaskOfficeName,
            't_generalTaskType' => $task -> t_generalTaskType,
            't_generalTaskLocation' => $task -> t_generalTaskLocation,
            't_generalTaskDueDate' => $new_date,
            't_generalTaskDueDateEnd' => $t_generalTaskDueDateEnd,
            't_generalTask_link' => $this -> generateTaskLink(),
            't_generalTaskDocRec' => $task -> t_generalTaskDocRec,
            't_generalTaskLibroCuaderno' => $task -> t_generalTaskLibroCuaderno,
            't_generalTask_idt_generalTask' => $task -> t_generalTask_idt_generalTask,
            't_generalTaskTitle'  => $task -> t_generalTaskTitle,
            't_generalTaskRepeat' => $task -> t_generalTaskRepeat,
            't_generalTaskRepeatMode' => $task -> t_generalTaskRepeatMode,
            't_clientes_idt_clientes' => $task -> t_clientes_idt_clientes,
            't_generalTaskCName' => $task -> t_generalTaskCName,
            't_generalTaskCPContact' => $task -> t_generalTaskCPContact,
            't_generalTaskCTelefono' => $task -> t_generalTaskCTelefono,
            't_generalTaskCEmail' => $task -> t_generalTaskCEmail,
            't_generalTaskCOffice' => $task -> t_generalTaskCOffice,
            't_usuarios_idt_usuarios' => $task -> t_usuarios_idt_usuarios,
            't_generalTaskTotalSubTask' => $task -> t_generalTaskTotalSubTask,
            't_generalTaskPriorityName' => $task -> t_generalTaskPriorityName,
            't_generalTaskPriorityNumber' => $task -> t_generalTaskPriorityNumber,
            't_generalTaskCFirstName' => $task -> t_generalTaskCFirstName,
            't_generalTaskCLastName' => $task -> t_generalTaskCLastName,
            't_generalTaskCNif' => $task -> t_generalTaskCNif,
            't_generalTaskExplanation' => $task -> t_generalTaskExplanation,
            't_generalTaskDirectory' => $task -> t_generalTaskDirectory,
            't_generalTaskRequiredValidation' => $task -> t_generalTaskRequiredValidation,
            't_generalTaskUserTookControl' => $task -> t_generalTaskUserTookControl
            ]
        );

        $p = (object) array(
            'father_a' => $task -> idt_generalTask,
            'father_b' => $id,
            't_generalTaskRepeatMode' => $task -> t_generalTaskRepeatMode
        );
        $this -> duplicateTaskFatherDocuments($p);
        $this -> duplicateTaskFatherNotes($p);
        $this -> duplicateTaskFatherAsigned($p);
        $this -> duplicateTaskSon($p);

        return $id;
    }

    /** 
     * Duplicate Son in new father 
     * father_a, father_b , t_generalTaskRepeatMode
    */
    public function duplicateTaskSon($p)
    {
        $task = DB::select("SELECT * FROM `t_task` where `t_generalTask_idt_generalTask` = ? ", [$p -> father_a]); 
        if (count($task) > 0) {
            foreach ($task as $t) {
                $new_due_date = $this -> createFutureDay($t -> t_taskDueDate, $p -> t_generalTaskRepeatMode);
                $id_new_task = DB::table('t_task') -> insertGetId(
                    [
                    't_generalTask_idt_generalTask' => $p -> father_b, 
                    't_taskUserCreated' => $t -> t_taskUserCreated, 
                    't_taskUserName' => $t -> t_taskUserName, 
                    't_taskDateCreated' => date('Y-m-d H:i:s'),
                    't_taskTitle' => $t -> t_taskTitle,
                    't_taskDueDate' => $new_due_date, 
                    't_taskPriorityName' => $t -> t_taskPriorityName,
                    't_taskPriorityNumber' => $t -> t_taskPriorityNumber,
                    't_taskRepeat' => $t -> t_taskRepeat, 
                    't_taskExplanation' => $t -> t_taskExplanation, 
                    't_taskDependence' => $t -> t_taskDependence, 
                    't_taskEnd' => $t -> t_taskEnd, 
                    't_taskRepeatMode' => $t -> t_taskRepeatMode, 
                    't_taskIsMain' => $t -> t_taskIsMain, 
                    't_taskCPContact' => $t -> t_taskCPContact, 
                    't_taskCTelefono' => $t -> t_taskCTelefono, 
                    't_taskCEmail' => $t -> t_taskCEmail, 
                    't_taskRequiredValidation' => $t -> t_taskRequiredValidation,
                    't_taskDirectory' => $t -> t_taskDirectory,
                    't_task_link' => $this -> generateTaskLink()
                    ]
                );

                $p_c = (object) array(
                    'son_a' => $t -> idt_task,
                    'son_b' => $id_new_task
                );

                $this -> duplicateTaskSonDocuments($p_c);
                $this -> duplicateTaskSonAsigned($p_c);
                $this -> duplicateTaskSonNotes($p_c);
            }
        }
    }

     /** 
     * Duplicate Documentos form A to B
     * son_a, son_b 
    */
    public function duplicateTaskSonDocuments($p)
    {   
        $documents = DB::select("SELECT * FROM `t_file_has_t_task` WHERE `t_file_has_t_task`.`t_task_idt_task` = ? ", [$p -> son_a]);
        foreach ($documents as $d) {
            $id_note = DB::table('t_file_has_t_task') -> insertGetId(
                [
                't_task_idt_task' => $p -> son_b,
                't_file_has_t_taskId' => sha1(md5(microtime())), 
                't_file_has_t_taskPointer' => 1,
                't_file_idt_file' => $d -> t_file_idt_file
                ]
            );
        }
    }

    /** 
     * Duplicate Documentos form A to B
     * father_a, father_b 
    */
    public function duplicateTaskFatherDocuments($p)
    {   
        $documents = DB::select("SELECT * FROM `t_file_has_t_task` WHERE `t_file_has_t_task`.`t_generalTask_idt_generalTask` = ? ", [$p -> father_a]);
        foreach ($documents as $d) {
            $id_note = DB::table('t_file_has_t_task') -> insertGetId(
                [
                't_generalTask_idt_generalTask' => $p -> father_b,
                't_file_has_t_taskId' => sha1(md5(microtime())), 
                't_file_has_t_taskPointer' => 1,
                't_file_idt_file' => $d -> t_file_idt_file
                ]
            );
        }
    }

    /** 
     * Duplicate Asigned form A to B
     * father_a, father_b 
    */
    public function duplicateTaskFatherAsigned($p)
    {
        $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_generalTask_idt_generalTask` = ? ", [$p -> father_a]);
        foreach ($task_assigned as $ta) {
            $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                [
                't_generalTask_idt_generalTask' => $p -> father_b,
                't_usuarios_idt_usuarios' => $ta -> t_usuarios_idt_usuarios,
                't_taskAssignedUserName' => $ta -> t_taskAssignedUserName,
                't_taskAssignedType' => $ta -> t_taskAssignedType,
                't_taskAssignedDate' => date('Y-m-d H:i:s')
                ]
            );
        }
    }

    /** 
     * Duplicate Asigned form A to B
     * son_a, son_b 
    */
    public function duplicateTaskSonAsigned($p)
    {
        $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$p -> son_a]);
        foreach ($task_assigned as $ta) {
            $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                [
                't_task_idt_task' => $p -> son_b,
                't_usuarios_idt_usuarios' => $ta -> t_usuarios_idt_usuarios,
                't_taskAssignedUserName' => $ta -> t_taskAssignedUserName,
                't_taskAssignedType' => $ta -> t_taskAssignedType,
                't_taskAssignedDate' => date('Y-m-d H:i:s')
                ]
            );
        }
    }
    
    /** 
     * Duplicate Notes form A to B
     * father_a, father_b 
    */
    public function duplicateTaskFatherNotes($p)
    {
        $notes = DB::select("SELECT * FROM `t_taskComments` WHERE `t_taskComments`.`t_generalTask_idt_generalTask` = ? ", [$p -> father_a]);
        foreach ($notes as $n) {
            $id_note = DB::table('t_taskComments') -> insertGetId(
                [
                't_generalTask_idt_generalTask' => $p -> father_b,
                't_usuarios_idt_usuarios' => $n -> t_usuarios_idt_usuarios, 
                't_taskCommentsUserName' => $n -> t_taskCommentsUserName, 
                't_taskCommentsDate' => $n -> t_taskCommentsDate,
                't_taskCommentsText' => $n -> t_taskCommentsText
                ]
            );
        }
    }

    /** 
     * Duplicate Notes form A to B
     * son_a, son_b 
    */
    public function duplicateTaskSonNotes($p)
    {
        $notes = DB::select("SELECT * FROM `t_taskComments` WHERE `t_taskComments`.`t_task_idt_task` = ? ", [$p -> son_a]);
        foreach ($notes as $n) {
            $id_note = DB::table('t_taskComments') -> insertGetId(
                [
                't_task_idt_task' => $p -> son_b,
                't_usuarios_idt_usuarios' => $n -> t_usuarios_idt_usuarios, 
                't_taskCommentsUserName' => $n -> t_taskCommentsUserName, 
                't_taskCommentsDate' => $n -> t_taskCommentsDate,
                't_taskCommentsText' => $n -> t_taskCommentsText
                ]
            );
        }
    }


    public function createFutureDay($t_taskDueDate, $t_taskRepeatMode)
    {
        $new_due_date = $t_taskDueDate;
        $temp_date = date('d', strtotime($t_taskDueDate));
        $use_last_day = false;
        if ($temp_date > 28) {
            if ($t_taskRepeatMode != 'yearly' && $t_taskRepeatMode != 'daily'  && $t_taskRepeatMode != 'weekly') {
                $use_last_day = true;
                $new_due_date = date('Y-m-d H:i:s', strtotime('-4 day', strtotime($new_due_date)));
            }
        }

        if ($t_taskRepeatMode == 'daily') {
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($new_due_date)));
        }

        if ($t_taskRepeatMode == 'weekly') { 
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 week', strtotime($new_due_date))); 
        }
        
        if ($t_taskRepeatMode == 'lastDay') { 
            $temp_day = explode(' ', $new_due_date);
            $temp_day_2 = explode('-', $temp_day[0]);
            $temp_day_2 = $temp_day_2[0].'-'.$temp_day_2[1].'-01 '.$temp_day[1];
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($temp_day_2)));
            $lastday = date('t', strtotime($new_due_date));

            $temp_day = explode(' ', $new_due_date);
            $temp_day_2 = explode('-', $temp_day[0]);
            $new_due_date = $temp_day_2[0].'-'.$temp_day_2[1].'-'.$lastday.' '.$temp_day[1];
        }

        if ($t_taskRepeatMode == 'monthly') { 
            if ($use_last_day) {
                $new_due_date = date('Y-m-t H:i:s', strtotime('+1 months', strtotime($new_due_date))); 
            } else {
                $new_due_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($new_due_date))); 
            }
        }

        if ($t_taskRepeatMode == 'quarterly') { 
            if ($use_last_day) {
                $new_due_date = date('Y-m-t H:i:s', strtotime('+3 months', strtotime($new_due_date))); 
            } else {
                $new_due_date = date('Y-m-d H:i:s', strtotime('+3 months', strtotime($new_due_date))); 
            }
        }

        if ($t_taskRepeatMode == 'biannual') { 
            if ($use_last_day) {
                $new_due_date = date('Y-m-t H:i:s', strtotime('+6 months', strtotime($new_due_date))); 
            } else {
                $new_due_date = date('Y-m-d H:i:s', strtotime('+6 months', strtotime($new_due_date)));
            }
        }

        if ($t_taskRepeatMode == 'yearly') {
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 years', strtotime($new_due_date))); 
        }

        return $new_due_date;
    }

    public function duplicateRepeatTaskSon($task) 
    {
        $new_created_date = $task[0] -> t_taskDateCreated;
        $new_due_date = $task[0] -> t_taskDueDate;
        $temp_date = date('d', strtotime($task[0] -> t_taskDueDate));
        $use_last_day = false;
        if ($temp_date > 28) {
            if ($task[0] -> t_taskRepeatMode != 'yearly' && $task[0] -> t_taskRepeatMode != 'daily'  && $task[0] -> t_taskRepeatMode != 'weekly') {
                $use_last_day = true;
                $new_due_date = date('Y-m-d H:i:s', strtotime('-4 day', strtotime($new_due_date))); 
            }
        }

        if ($task[0] -> t_taskRepeatMode == 'daily') { 
            $new_created_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($new_created_date)));
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($new_due_date))); 
        }

        if ($task[0] -> t_taskRepeatMode == 'weekly') { 
            $new_created_date = date('Y-m-d H:i:s', strtotime('+1 week', strtotime($new_created_date)));
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 week', strtotime($new_due_date))); 
        }

       
        
        if ($task[0] -> t_taskRepeatMode == 'lastDay') { 
            $new_created_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($new_created_date)));
            
            $temp_day = explode(' ', $new_due_date);
            $temp_day_2 = explode('-', $temp_day[0]);
            $temp_day_2 = $temp_day_2[0].'-'.$temp_day_2[1].'-01 '.$temp_day[1];
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($temp_day_2)));
            $lastday = date('t', strtotime($new_due_date));

            $temp_day = explode(' ', $new_due_date);
            $temp_day_2 = explode('-', $temp_day[0]);
            $new_due_date = $temp_day_2[0].'-'.$temp_day_2[1].'-'.$lastday.' '.$temp_day[1];
        }

        if ($task[0] -> t_taskRepeatMode == 'monthly') { 
            if ($use_last_day) {
                $new_created_date = date('Y-m-t H:i:s', strtotime('+1 months', strtotime($new_created_date))); 
                $new_due_date = date('Y-m-t H:i:s', strtotime('+1 months', strtotime($new_due_date))); 
            } else {
                $new_created_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($new_created_date))); 
                $new_due_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($new_due_date))); 
            }
           
        }

        if ($task[0] -> t_taskRepeatMode == 'quarterly') { 
            if ($use_last_day) {
                $new_created_date = date('Y-m-t H:i:s', strtotime('+3 months', strtotime($new_created_date)));
                $new_due_date = date('Y-m-t H:i:s', strtotime('+3 months', strtotime($new_due_date))); 
            } else {
                $new_created_date = date('Y-m-d H:i:s', strtotime('+3 months', strtotime($new_created_date)));
                $new_due_date = date('Y-m-d H:i:s', strtotime('+3 months', strtotime($new_due_date))); 
            }
            
        }
        if ($task[0] -> t_taskRepeatMode == 'biannual') { 
            if ($use_last_day) {
                $new_created_date = date('Y-m-t H:i:s', strtotime('+6 months', strtotime($new_created_date)));
                $new_due_date = date('Y-m-t H:i:s', strtotime('+6 months', strtotime($new_due_date))); 
            } else {
                $new_created_date = date('Y-m-d H:i:s', strtotime('+6 months', strtotime($new_created_date)));
                $new_due_date = date('Y-m-d H:i:s', strtotime('+6 months', strtotime($new_due_date)));
            }
            
        }
        if ($task[0] -> t_taskRepeatMode == 'yearly') {
            $new_created_date = date('Y-m-d H:i:s', strtotime('+1 years', strtotime($new_created_date)));
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 years', strtotime($new_due_date))); 
           
        }

        
        $id_new_task = DB::table('t_task') -> insertGetId(
            [
            't_generalTask_idt_generalTask' => $task[0] -> t_generalTask_idt_generalTask, 
            't_taskUserCreated' => $task[0] -> t_taskUserCreated, 
            't_taskUserName' => $task[0] -> t_taskUserName, 
            't_taskDateCreated' => $new_created_date,
            't_taskTitle' => $task[0] -> t_taskTitle,
            't_taskDueDate' => $new_due_date, 
            't_taskPriorityName' => $task[0] -> t_taskPriorityName,
            't_taskPriorityNumber' => $task[0] -> t_taskPriorityNumber,
            't_taskRepeat' => $task[0] -> t_taskRepeat, 
            't_taskExplanation' => $task[0] -> t_taskExplanation, 
            't_taskDependence' => $task[0] -> t_taskDependence, 
            't_taskEnd' => $task[0] -> t_taskEnd, 
            't_taskRepeatMode' => $task[0] -> t_taskRepeatMode, 
            't_taskIsMain' => $task[0] -> t_taskIsMain, 
            't_taskCPContact' => $task[0] -> t_taskCPContact, 
            't_taskCTelefono' => $task[0] -> t_taskCTelefono, 
            't_taskCEmail' => $task[0] -> t_taskCEmail, 
            't_taskRequiredValidation' => $task[0] -> t_taskRequiredValidation,
            't_taskDirectory' => $task[0] -> t_taskDirectory,
            't_task_link' => $this -> generateTaskLink()
            ]
        );

        $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$task[0] -> idt_task]);
        foreach ($task_assigned as $ta) {
            $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                [
                't_task_idt_task' => $id_new_task,
                't_usuarios_idt_usuarios' => $ta -> t_usuarios_idt_usuarios,
                't_taskAssignedUserName' => $ta -> t_taskAssignedUserName,
                't_taskAssignedType' => $ta -> t_taskAssignedType,
                't_taskAssignedDate' => date('Y-m-d H:i:s')
                ]
            );
        }

        $notes = DB::select("SELECT * FROM `t_taskComments` WHERE `t_taskComments`.`t_task_idt_task` = ? ", [$task[0] -> idt_task]);
        foreach ($notes as $n) {
            $id_note = DB::table('t_taskComments') -> insertGetId(
                [
                't_task_idt_task' => $id_new_task,
                't_usuarios_idt_usuarios' => $n -> t_usuarios_idt_usuarios, 
                't_taskCommentsUserName' => $n -> t_taskCommentsUserName, 
                't_taskCommentsDate' => $n -> t_taskCommentsDate,
                't_taskCommentsText' => $n -> t_taskCommentsText
                ]
            );
        }

        $documents = DB::select("SELECT * FROM `t_file_has_t_task` WHERE `t_file_has_t_task`.`t_task_idt_task` = ? ", [$task[0] -> idt_task]);
        foreach ($documents as $d) {
            $id_note = DB::table('t_file_has_t_task') -> insertGetId(
                [
                't_task_idt_task' => $id_new_task,
                't_file_has_t_taskId' => sha1(md5(microtime())), 
                't_file_has_t_taskPointer' => 1,
                't_file_idt_file' => $d -> t_file_idt_file
                ]
            );
        }
           

    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function completedTask(Request $request)
    {
        
        if (isset(Session::get('user') -> idt_usuarios)) {
            if ($request -> type == 'father') {
                $task = DB::select("SELECT * FROM `t_generalTask` WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                if ($task[0] -> t_generalTaskRequiredValidation == 1) {
                    $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ? AND `t_taskAssigned`.`t_usuarios_idt_usuarios` = ?", [$request -> id, Session::get('user') -> idt_usuarios]);
                    $valida = false;
                    $responsable = false;
                    $copia = false;
                    foreach ($task_assigned as $ta) {
                        if ($ta -> t_taskAssignedType == 'Realiza') {
                            $responsable = true;
                        }
                        if ($ta -> t_taskAssignedType == 'Valida') {
                            $valida = true;
                        }
                        if ($ta -> t_taskAssignedType == 'CC') {
                            $copia = true;
                        }
                    }
                    if ($valida) {
                        $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ?, t_generalTaskUserValidated = ?, t_generalTaskUserNameValidated = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', ['Completed',date('Y-m-d H:i:s'), Session::get('user') -> idt_usuarios, Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido,$request -> id]);
                    } elseif ($responsable) {
                        $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', ['waiting_validation',date('Y-m-d H:i:s'),$request -> id]);
                    }
                } else {
                    $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', ['Completed',date('Y-m-d H:i:s'),$request -> id]);
                    if ($task[0] -> t_generalTaskRepeatMode != '' && $task[0] -> t_generalTaskRepeatMode != 'no_repeart') {
                        $this -> duplicateRepeatTaskFather($task[0]);
                    }
                }
            }

            if ($request -> type == 'son') {
               
                $task = DB::select("SELECT * FROM `t_task` WHERE sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                $id_father = $task[0] -> t_generalTask_idt_generalTask;
                if ($task[0] -> t_taskRequiredValidation == 1) {
                    $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_task_idt_task`)) = ? AND `t_taskAssigned`.`t_usuarios_idt_usuarios` = ?", [$request -> id, Session::get('user') -> idt_usuarios]);
                    $valida = false;
                    $responsable = false;
                    $copia = false;
                    foreach ($task_assigned as $ta) {
                        if ($ta -> t_taskAssignedType == 'Realiza') {
                            $responsable = true;
                        }
                        if ($ta -> t_taskAssignedType == 'Valida') {
                            $valida = true;
                        }
                        if ($ta -> t_taskAssignedType == 'CC') {
                            $copia = true;
                        }
                    }
                    
                    if ($valida) {
                        $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ?, t_taskValidated = ?, t_taskUserValidated = ?, t_taskUserNameValidated = ?  WHERE sha1(md5(`t_task`.`idt_task`)) = ?', ['Completed',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'), Session::get('user') -> idt_usuarios, Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido,$request -> id]);
                        if ($task[0] -> t_taskRepeatMode != '' && $task[0] -> t_taskRepeatMode != 'no_repeart') {
                            $this -> duplicateRepeatTaskSon($task);
                        }
                        $affected = DB::update('UPDATE `t_task` SET `t_taskDependenceDone` = 1  WHERE sha1(md5(`t_task`.`t_taskDependence`)) = ?', [$request -> id]);
                        

                        $taskA = DB::select("SELECT * FROM `t_generalTask` , `t_task` where `t_task`.`t_generalTask_idt_generalTask` = ? AND (`t_task`.`t_taskStatus` !='Completed' OR `t_task`.`t_taskStatus` is null) AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`", [$id_father]);
                        if (count($taskA) > 0) {
        
                        } else {
                            $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE `t_generalTask`.`idt_generalTask` = ?', ['Completed',date('Y-m-d H:i:s'),$id_father]);
                        }
                        $affected = true; 
                    } elseif ($responsable) {
                        $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ?, t_taskChecked = ?, t_taskUserChecked = ?, t_taskUserNameChecked = ?  WHERE sha1(md5(`t_task`.`idt_task`)) = ?', ['waiting_validation',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'), Session::get('user') -> idt_usuarios, Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido,$request -> id]);
                        $affected = true; 
                    } else {

                    }

                } else {
                    //$affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', ['Completed',date('Y-m-d H:i:s'),$request -> id]);
                    $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ?, t_taskChecked = ?, t_taskUserChecked = ?, t_taskUserNameChecked = ?  WHERE sha1(md5(`t_task`.`idt_task`)) = ?', ['Completed',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'), Session::get('user') -> idt_usuarios, Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido,$request -> id]);
                    $affected = DB::update('UPDATE `t_task` SET `t_taskDependenceDone` = 1  WHERE sha1(md5(`t_task`.`t_taskDependence`)) = ?', [$request -> id]);
                    $affected = true;   
                   
                    if ($task[0] -> t_taskRepeatMode != '') {
                        $this -> duplicateRepeatTaskSon($task);
                        
                        
                    } else {

                        $taskA = DB::select("SELECT * FROM `t_generalTask` , `t_task` where `t_task`.`t_generalTask_idt_generalTask` = ? AND (`t_task`.`t_taskStatus` !='Completed' OR `t_task`.`t_taskStatus` is null) AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`", [$id_father]);
                        if (count($taskA) > 0) {
        
                        } else {
                            //$affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE `t_generalTask`.`idt_generalTask` = ?', ['Completed',date('Y-m-d H:i:s'),$id_father]);
                       
                        }
                    }
                }
                
            }

            if ($affected) {
                return response() -> json(['message' => '', 'status' => true]);
            } else {
                return response() -> json(['message' => '', 'status' => false]);
            }
        }
        
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function incompleteTask(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            if ($request -> type == 'father') {
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [null,date('Y-m-d H:i:s'),$request -> id]);
            }

            if ($request -> type == 'son') {
                $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ?, `t_taskEnd` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [null,date('Y-m-d H:i:s'),$request -> id]);
                $task = DB::select("SELECT * FROM `t_task` WHERE sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                $id_father = $task[0] -> t_generalTask_idt_generalTask;
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ?, t_generalTaskEnd = ? WHERE `t_generalTask`.`idt_generalTask` = ?', [null,date('Y-m-d H:i:s'),$id_father]);
                
            }


            if ($affected) {
                return response() -> json(['message' => '', 'status' => true]);
            } else {
                return response() -> json(['message' => '', 'status' => false]);
            }
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function getMeetingInvited(Request $request)
    {
        $list = DB::select("SELECT * FROM `t_meeting_invited` WHERE sha1(md5(t_generalTask_idt_generalTask)) = ?", [$request -> id]);
        return response() -> json(['list_inv' => $list]);
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function removeMeetingInvited(Request $request)
    {
        $affected = DB::update('DELETE FROM `t_meeting_invited` WHERE `idt_meeting_invited` = ?', [$request -> id]);
        return $affected;
                   
    }

    

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function editTaskA(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {

            if (isset($request -> notify)) {
                $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned`, `t_usuarios` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ? AND t_taskAssignedType = 'Realiza' AND  `t_usuarios`.`idt_usuarios` = `t_taskAssigned`.`t_usuarios_idt_usuarios`", [$request -> id]);
                $task =  DB::select("SELECT * FROM `t_generalTask`  where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ? ", [$request -> id]);
                foreach ($task_assigned as $asig) {
                    if ($asig -> t_usuariosReferencia == '') {
                        $asig -> t_usuariosReferencia = '';
                    }
                    $p = array();
                    $p['email'] = $asig -> t_usuariosEmail;
                    $p['nombre_usuario'] = $asig -> t_usuariosNombre.' '.$asig -> t_usuariosApellido;
                    $p['task_title'] = $task[0] -> t_generalTaskTitle;
                    $p['customer'] = $task[0] -> t_generalTaskCName;
                    $p['urgente'] = $task[0] -> t_generalTaskPriorityNumber;
                    $p['owner'] = $task[0] -> t_generalTaskUsuarioName;
                    $p['user_referencia'] = $asig -> t_usuariosReferencia;
                    $p['from_lettle'] = substr(Session::get('user') -> t_usuariosNombre, 0, 1).substr(Session::get('user') -> t_usuariosApellido, 0, 1);
                    $p['from_name'] = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                    $p['text_a'] = 'Te ha asignado una Tarea.';
                    $p['location'] = '';
                    $p['due_time'] = '';

                   
                    $due_date = '';
                    $time = '';
                    if ($task[0] -> t_generalTaskDueDate != '') {
                        $due_date = explode(' ', $task[0] -> t_generalTaskDueDate);
                        $time = $due_date[1];
                        $due_date = $due_date[0];
                        $due_date = explode('-', $due_date);
                        $due_date = $due_date[2].'-'.$due_date[1].'-'.$due_date[0];
                    }
                    $p['subject'] = 'Tarea Asignada';

                    $p['type'] = $task[0] -> t_generalTaskType;
                    if ($task[0] -> t_generalTaskType == 'Meeting') { 
                        $p['subject'] = 'Invitación a Reunión';
                        $p['text_a'] = 'Te ha invitado a una Reunión.';
                        $p['location'] = $task[0] -> t_generalTaskLocation;
                        $p['due_time'] = $time;
                    }


                    if ($task[0] -> t_generalTaskType == 'Project') {
                        $p['subject'] = 'Nueva Anotación';
                        $p['owner'] = '';
                        $p['text_a'] = 'Se ha creado una nueva anotación.';
                        
                    }

                    $p['due_date'] = $due_date;
                    if ($asig -> t_usuariosEmail != '') {
                        $this -> sendMailAssigned($p);
                    }
                    
                }
            }


            
            if (isset($request -> t_meeting_invited)) {
                $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                $id_2 = DB::table('t_meeting_invited') -> insertGetId(
                    [
                    't_generalTask_idt_generalTask' => $task[0] -> idt_generalTask, 
                    't_meeting_invitedName' => $request -> name, 
                    't_meeting_invitedEmail' => $request -> email, 
                    't_meeting_invitedPhone' => $request -> phone
                    ]
                );
            }

            if (isset($request -> t_generalTaskTitle)) {
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskTitle` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskTitle,$request -> id]);
                $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                if ($task[0] -> t_generalTaskStatus == 'Deleted') {
                    $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [null, $request -> id]);
                    
                }
            
            }

            if (isset($request -> deleteTask)) {
                $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                if ($task[0] -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                    $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskStatus` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', ['Deleted', $request -> id]);
                    $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ? WHERE sha1(md5(`t_task`.`t_generalTask_idt_generalTask`)) = ?', ['Deleted', $request -> id]);
                }
            }
            
            if (isset($request -> overwriteContact)) { 
                $task =  DB::select("SELECT * FROM `t_task`  WHERE sha1(md5(`t_task`.`t_generalTask_idt_generalTask`)) = ?", [$request -> id]);
                foreach ($task as $t) {
                    $affected = DB::update('UPDATE `t_task` SET `t_taskCPContact` = ?, `t_taskCTelefono` = ?, `t_taskCEmail` = ? WHERE `t_task`.`idt_task` = ?', [null, null, null, $t -> idt_task]);
                }
                
            }
            
            if (isset($request -> t_generalTaskPriorityNumber)) { 
                if ($request -> t_generalTaskPriorityNumber == 1) {
                    $priority = 0;
                } else {
                    $priority = 1;
                }
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskPriorityNumber` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$priority, $request -> id]);
            }

            if (isset($request -> t_generalTaskLocation)) { 
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskLocation` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskLocation, $request -> id]);
            }

            if (isset($request -> t_generalTaskCriticalDate)) { 
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskCriticalDate` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskCriticalDate, $request -> id]);
            }

            

            if (isset($request -> t_generalTaskRepeatMode)) { 
               $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskRepeatMode` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskRepeatMode, $request -> id]);
            }

            if (isset($request -> t_generalTaskLibroCuaderno)) { 
                $t_generalTaskLibroCuaderno = 'Cuaderno';

                if ($request -> t_generalTaskLibroCuaderno == 'Cuaderno') {
                    $t_generalTaskLibroCuaderno = 'Libro';
                } else {
                    $t_generalTaskLibroCuaderno = 'Cuaderno';
                }
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskLibroCuaderno` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$t_generalTaskLibroCuaderno, $request -> id]);
            }

            if (isset($request -> t_generalTaskDocRec)) { 
                $t_generalTaskDocRec = 'Documental';

                if ($request -> t_generalTaskDocRec == 'Documental') {
                    $t_generalTaskDocRec = 'Recordatorio';
                } else {
                    $t_generalTaskDocRec = 'Documental';
                }
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskDocRec` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$t_generalTaskDocRec, $request -> id]);
            }

            
            if (isset($request -> t_generalTaskDirectory)) { 
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskDirectory` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskDirectory, $request -> id]);
            }
            if (isset($request -> t_generalTaskExplanation)) { 
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskExplanation` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskExplanation, $request -> id]);
            }
            if (isset($request -> t_generalTaskDueDate)) { 
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskDueDate` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskDueDate, $request -> id]);
            }

            if (isset($request -> t_generalTaskDueDateEnd)) { 
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskDueDateEnd` = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [$request -> t_generalTaskDueDateEnd, $request -> id]);
            }

            if (isset($request -> cleanCustomer)) { 
                $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                if ($task[0] -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                    $affected = DB::update('UPDATE `t_generalTask` SET t_generalTaskCNif = ?, `t_clientes_idt_clientes` = ?, t_generalTaskCName = ? , t_generalTaskCPContact = ?, t_generalTaskCTelefono = ?, t_generalTaskCEmail = ?, t_generalTaskCFirstName = ?, t_generalTaskCLastName = ?  WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [null, null, null, null, null, null, null, null, $request -> id]);
                }
            }

            

            if ($request -> customerControl == 'form') {
                $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                if ($task[0] -> t_usuarios_idt_usuarios == Session::get('user') -> idt_usuarios) {
                    if ($request -> idt_clientes == '') {
                        if ($request -> t_clientesNif_1 != '' && $request -> t_clientesNombre != '' ) {
                            $id_cliente = DB::table('t_clientes') -> insertGetId(['t_clientesNombre' => $request -> t_clientesNombre ,'t_clientesApellido' => $request -> t_clientesApellido, 't_clientesTelefono' => $request -> t_clientesTelefono,'t_clientesEmail' => $request -> t_clientesEmail , 't_clientesNif' => strtoupper($request -> t_clientesNif_1),  't_usuarios_idt_usuarios_CreadoPor' => Session::get('user') -> idt_usuarios, 't_clientesDate' => date('Y-m-d'), 't_clientesTipoCliente' => Session::get('mode_system')]);
                        } else {
                            if ($request -> t_generalTaskCPContact != '' || $request -> t_clientesEmail != '' || $request -> t_clientesTelefono != '') {
                                $affected = DB::update(
                                    'UPDATE `t_generalTask` SET t_generalTaskCPContact = ?, t_generalTaskCTelefono = ?, t_generalTaskCEmail = ? WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', 
                                    [ $request -> t_generalTaskCPContact, $request-> t_clientesTelefono, $request -> t_clientesEmail, $request -> id]
                                );
                            }
                            return response() -> json([ 'message' => '', 'status' => false]);
                        }
                    } else {
                        $id_cliente = $request -> idt_clientes;
                    }

                    $affected = DB::update(
                        'UPDATE `t_generalTask` SET t_generalTaskCNif = ?, `t_clientes_idt_clientes` = ?, t_generalTaskCName = ? , t_generalTaskCPContact = ?, t_generalTaskCTelefono = ?, t_generalTaskCEmail = ?, t_generalTaskCFirstName = ?, t_generalTaskCLastName = ?  WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', 
                        [strtoupper($request -> t_clientesNif_1),$id_cliente, $request -> t_clientesNombre.' '.$request -> t_clientesApellido, $request -> t_generalTaskCPContact, $request-> t_clientesTelefono, $request -> t_clientesEmail, $request -> t_clientesNombre, $request -> t_clientesApellido, $request -> id]
                    );
                }
            } 

            if (isset($request -> assignedTeamFather)) {
                $team = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
                $create = true;
                $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
                $t_task_idt_task = $task[0] -> idt_generalTask;
                $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskRequiredValidation` = 0 WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [ $request -> id]);
                $affected = DB::update('DELETE FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ?', [$request -> id]);
                foreach ($team as $t) {
                    $var = 'user_'.$t -> idt_usuarios;
                    if ($create) {
                        $affected = DB::update('DELETE FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ?', [$request -> id]);
                    }
                    if (isset($request -> $var)) {
                        
                        $create = false;
                        $t_taskAssignedType = 'user_type_'.$t -> idt_usuarios;
                        $task_assigned_check = DB::select("SELECT * FROM `t_taskAssigned` WHERE  `t_taskAssigned`.`t_usuarios_idt_usuarios` = ? AND `t_taskAssigned`.`t_generalTask_idt_generalTask` = ? ", [$t -> idt_usuarios,$t_task_idt_task]);
                        if (count($task_assigned_check) > 0) {
                            
                        } else {
                            if ($request -> $t_taskAssignedType != '' ) {
                                $affected_de = DB::update('DELETE FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_usuarios_idt_usuarios` = ? AND sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ?', [$t -> idt_usuarios,$request -> id]);
                
                                $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                                    [
                                    't_generalTask_idt_generalTask' => $t_task_idt_task, 
                                    't_usuarios_idt_usuarios' => $t -> idt_usuarios, 
                                    't_taskAssignedUserName' => $t -> t_usuariosNombre.' '.$t -> t_usuariosApellido, 
                                    't_taskAssignedType' => $request -> $t_taskAssignedType,
                                    't_taskAssignedDate' => date('Y-m-d H:i:s')
                                    ]
                                );
                                if ($request -> $t_taskAssignedType == 'Valida') {
                                    $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskRequiredValidation` = 1 WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [ $request -> id]);
                    
                                }
                            }
                        }
                       

                        // if ($t -> idt_usuarios != Session::get('user') -> idt_usuarios) {
                        //     $p = array();
                        //     $p['email'] = $t -> t_usuariosEmail;
                        //     $p['nombre_usuario'] = $t -> t_usuariosNombre.' '.$t -> t_usuariosApellido;
                        //     $p['task_title'] = $task[0] -> t_generalTaskTitle;
                        //     $p['from_lettle'] = substr(Session::get('user') -> t_usuariosNombre, 0, 1).substr(Session::get('user') -> t_usuariosApellido, 0, 1); 
                        //     $p['from_name'] = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido; 
                        //     $due_date = '';
                        //     if ($task[0] -> t_generalTaskDueDate != '') {
                        //         $due_date = explode(' ', $task[0] -> t_generalTaskDueDate);
                        //         $due_date = $due_date[0];
                        //         $due_date = explode('-', $due_date);
                        //         $due_date = $due_date[2].'-'.$due_date[1].'-'.$due_date[0];
                        //     }

                        //     $p['due_date'] = $due_date;
                        //     if ($t -> t_usuariosEmail != '') {
                        //         $this -> sendMailAssigned($p);
                        //     }
                            
                        // }
                    }
                } 
                // if ($create) {
                //     $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                //         [
                //         't_generalTask_idt_generalTask' => $t_task_idt_task , 
                //         't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                //         't_taskAssignedUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
                //         't_taskAssignedType' => 'Realiza',
                //         't_taskAssignedDate' => date('Y-m-d H:i:s')
                //         ]
                //     );
                // }
            }

            
            // return $request;
            $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ? ", [$request -> id]);
            $task =  DB::select("SELECT *  FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
            $task[0] -> can_edit = true;
            return response() -> json(['task' => $task, 'message' => '', 'status' => true, 'taskAssigned' => $task_assigned, 'taskAssignedDefault' => Session::get('user') -> idt_usuarios]);
            //return $request;
        }
    }

    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    function editTaskSon(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            
            if ($request -> SubTaskCustomerControl == 'form') {
                $affected = DB::update('UPDATE `t_task` SET `t_taskCPContact` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskCPContact,$request -> id]);
                $affected = DB::update('UPDATE `t_task` SET `t_taskCTelefono` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskCTelefono,$request -> id]);
                $affected = DB::update('UPDATE `t_task` SET `t_taskCEmail` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskCEmail,$request -> id]);
            }

            
            if (isset($request -> notify)) {
                $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned`, `t_usuarios` WHERE sha1(md5(`t_taskAssigned`.`t_task_idt_task`)) = ? AND t_taskAssignedType = 'Realiza' AND  `t_usuarios`.`idt_usuarios` = `t_taskAssigned`.`t_usuarios_idt_usuarios`", [$request -> id]);
                $task =  DB::select("SELECT * FROM `t_generalTask` ,`t_task` where sha1(md5(`t_task`.`idt_task`)) = ? AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`", [$request -> id]);
                foreach ($task_assigned as $asig) {
                    
                    $p = array();
                    if ($asig -> t_usuariosReferencia == '') {
                        $asig -> t_usuariosReferencia = '';
                    }
                    $p['email'] = $asig -> t_usuariosEmail;
                    $p['nombre_usuario'] = $asig -> t_usuariosNombre.' '.$asig -> t_usuariosApellido;
                    $p['task_title'] = $task[0] -> t_taskTitle;
                    $p['customer'] = $task[0] -> t_generalTaskCName;
                    $p['urgente'] = $task[0] -> t_taskPriorityNumber;
                    $p['owner'] = $task[0] -> t_taskUserName;
                    $p['user_referencia'] =  $asig -> t_usuariosReferencia;
                    $p['from_lettle'] = substr(Session::get('user') -> t_usuariosNombre, 0, 1).substr(Session::get('user') -> t_usuariosApellido, 0, 1);
                    $p['from_name'] = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                    $p['text_a'] = 'Te ha asignado una Tarea.';
                    $p['location'] = '';
                    $p['due_time'] = '';
                    $p['type'] = $task[0] -> t_generalTaskType;
                    $due_date = '';
                    if ($task[0] -> t_taskDueDate != '') {
                        $due_date = explode(' ', $task[0] -> t_taskDueDate);
                        $due_date = $due_date[0];
                        $due_date = explode('-', $due_date);
                        $due_date = $due_date[2].'-'.$due_date[1].'-'.$due_date[0];
                    }
                    $p['subject'] = 'Tarea Asignada';
                    $p['due_date'] = $due_date;
                    if ($asig -> t_usuariosEmail != '') {
                        $this -> sendMailAssigned($p);
                    }
                    
                }
            }

            if (isset($request -> t_taskPriorityNumber)) {
                if ($request -> t_taskPriorityNumber == 1) {
                    $priority = 0;
                } else {
                    $priority = 1;
                }
                $affected = DB::update('UPDATE `t_task` SET `t_taskPriorityNumber` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$priority,$request -> id]);

                // if ($priority == 1) {
                //     $task_assigned = DB::select("SELECT * FROM `t_taskAssigned`, `t_usuarios` WHERE sha1(md5(`t_taskAssigned`.`t_task_idt_task`)) = ? AND t_taskAssignedType = 'Realiza' AND  `t_usuarios`.`idt_usuarios` = `t_taskAssigned`.`t_usuarios_idt_usuarios`", [$request -> id]);
                //     $task =  DB::select("SELECT * FROM `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                //     foreach ($task_assigned as $asig) {
                //         if ($asig -> t_usuarios_idt_usuarios != Session::get('user') -> idt_usuarios) {
                //             $p = array();
                //             $p['email'] = $asig -> t_usuariosEmail;
                //             $p['nombre_usuario'] = $asig -> t_usuariosNombre.' '.$asig -> t_usuariosApellido;
                //             $p['task_title'] = $task[0] -> t_taskTitle;
                //             $p['from_lettle'] = substr(Session::get('user') -> t_usuariosNombre, 0, 1).substr(Session::get('user') -> t_usuariosApellido, 0, 1);
                //             $p['from_name'] = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                            
                //             $due_date = '';
                //             if ($task[0] -> t_taskDueDate != '') {
                //                 $due_date = explode(' ', $task[0] -> t_taskDueDate);
                //                 $due_date = $due_date[0];
                //                 $due_date = explode('-', $due_date);
                //                 $due_date = $due_date[2].'-'.$due_date[1].'-'.$due_date[0];
                //             }

                //             $p['due_date'] = $due_date;
                //             if ($asig -> t_usuariosEmail != '') {
                //                 $this -> sendMailAssigned($p);
                //             }
                //         }
                //     }
                // }
            }
            
            if (isset($request -> t_taskDependence)) {
                if ($request -> t_taskDependence == 'no_dependence') {
                    $request -> t_taskDependence = null;
                    $affected = DB::update('UPDATE `t_task` SET `t_taskDependence` = ?, `t_task`.`t_taskDependenceDone` = 1 WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskDependence,$request -> id]);
           
                } else {
                    $task =  DB::select("SELECT * FROM `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> t_taskDependence]);
                    $request -> t_taskDependence = $task[0] ->  idt_task;
                    $affected = DB::update('UPDATE `t_task` SET `t_taskDependence` = ?, `t_task`.`t_taskDependenceDone` = 0  WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskDependence,$request -> id]);
           
                }
                
                
            }
            if (isset($request -> deleteTask)) {
                $task =  DB::select("SELECT * FROM `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                if ($task[0] -> t_taskUserCreated == Session::get('user') -> idt_usuarios) {
                    $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', ['Deleted', $request -> id]);
                }
            }

            if (isset($request -> t_taskRepeatMode)) {
                if ($request -> t_taskRepeatMode == 'no_repeart') {
                    $request -> t_taskRepeatMode = null;
                }
                $affected = DB::update('UPDATE `t_task` SET `t_taskRepeatMode` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskRepeatMode,$request -> id]);
            } 

            if (isset($request -> t_taskDirectory)) {
                $affected = DB::update('UPDATE `t_task` SET `t_taskDirectory` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskDirectory,$request -> id]);
            }

            if (isset($request -> t_taskCriticalDay)) {
                $affected = DB::update('UPDATE `t_task` SET `t_taskCriticalDay` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskCriticalDay,$request -> id]);
            }


            

            if (isset($request -> t_taskTitle)) {
                $affected = DB::update('UPDATE `t_task` SET `t_taskTitle` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskTitle,$request -> id]);
                $task =  DB::select("SELECT * FROM `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                if ($task[0] -> t_taskStatus == 'Deleted') {
                    $affected = DB::update('UPDATE `t_task` SET `t_taskStatus` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [null, $request -> id]);
                
                }
            
            }

            if (isset($request -> t_taskExplanation)) {
                $affected = DB::update('UPDATE `t_task` SET `t_taskExplanation` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskExplanation,$request -> id]);
            }

            if (isset($request -> t_taskDueDate)) {
                $task =  DB::select("SELECT * FROM `t_task`, `t_generalTask` where  `t_generalTask`.`idt_generalTask` =  `t_task`.`t_generalTask_idt_generalTask` AND  sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                if ($task[0] -> t_generalTaskDueDate == '') {
                    $affected = DB::update('UPDATE `t_task` SET `t_taskDueDate` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskDueDate,$request -> id]);
                } else {
                    $a = explode(' ', $task[0] -> t_generalTaskDueDate);
                    $a = $a[0];
                    $b = explode(' ', $request -> t_taskDueDate);
                    $b = $b[0];
                    if ((new \DateTime($a) >= new \DateTime($b))||($task[0] -> t_generalTaskType == 'Meeting')) {
                        $affected = DB::update('UPDATE `t_task` SET `t_taskDueDate` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [$request -> t_taskDueDate,$request -> id]);
                        $affected = DB::update('UPDATE `t_task` SET `t_taskEnd` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($request -> t_taskDueDate))),$request -> id]);
                        
                    } else {
                        return response() -> json([ 'status' => false, 'date' => $task[0] -> t_generalTaskDueDate]);
                    }
                }
            }
            
            if (isset($request -> assignedTeam)) {
                $team = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
                $create = true;
                $task =  DB::select("SELECT * FROM `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?", [$request -> id]);
                $t_task_idt_task = $task[0] -> idt_task;
                $affected_3 = DB::update('UPDATE `t_task` SET `t_taskRequiredValidation` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [0,$request -> id]);
                $affected = DB::update('DELETE FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_task_idt_task`)) = ?', [$request -> id]);

                foreach ($team as $t) {
                    $var = 'user_'.$t -> idt_usuarios;
                    if ($create) {
                        $affected = DB::update('DELETE FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_task_idt_task`)) = ?', [$request -> id]);

                    }
                    if (isset($request -> $var)) {
                        
                        $create = false;
                        $t_taskAssignedType = 'user_type_'.$t -> idt_usuarios;
                        $task_assigned_check = DB::select("SELECT * FROM `t_taskAssigned` WHERE  `t_taskAssigned`.`t_usuarios_idt_usuarios` = ? AND `t_taskAssigned`.`t_task_idt_task` = ? ", [$t -> idt_usuarios,$t_task_idt_task]);
                        if (count($task_assigned_check) > 0) {
                           
                        } else {
                            $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                                [
                                't_task_idt_task' => $t_task_idt_task, 
                                't_usuarios_idt_usuarios' => $t -> idt_usuarios, 
                                't_taskAssignedUserName' => $t -> t_usuariosNombre.' '.$t -> t_usuariosApellido, 
                                't_taskAssignedType' => $request -> $t_taskAssignedType,
                                't_taskAssignedDate' => date('Y-m-d H:i:s')
                                ]
                            );
    
                            if ($request -> $t_taskAssignedType == 'Valida') {
                                DB::update('UPDATE `t_task` SET `t_taskRequiredValidation` = ? WHERE sha1(md5(`t_task`.`idt_task`)) = ?', [1,$request -> id]);
                            }
                        }
                        

                        // if ($t -> idt_usuarios != Session::get('user') -> idt_usuarios) {
                        //     if ($task[0] -> t_taskPriorityNumber == 1) {
                        //         $p = array();
                        //         $p['email'] = $t -> t_usuariosEmail;
                        //         $p['nombre_usuario'] = $t -> t_usuariosNombre.' '.$t -> t_usuariosApellido;
                        //         $p['task_title'] = $task[0] -> t_taskTitle;
                        //         $p['from_lettle'] = substr(Session::get('user') -> t_usuariosNombre, 0, 1).substr(Session::get('user') -> t_usuariosApellido, 0, 1);
                        //         $p['from_name'] = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                                
                        //         $due_date = '';
                        //         if ($task[0] -> t_taskDueDate != '') {
                        //             $due_date = explode(' ', $task[0] -> t_taskDueDate);
                        //             $due_date = $due_date[0];
                        //             $due_date = explode('-', $due_date);
                        //             $due_date = $due_date[2].'-'.$due_date[1].'-'.$due_date[0];
                        //         }
                        //         $p['due_date'] = $due_date;
                        //         if ($t -> t_usuariosEmail != '') {
                        //             $this -> sendMailAssigned($p);
                        //         }
                        //     }
                        // }
                    }
                } 
                if ($create) {
                    // $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                    //     [
                    //     't_task_idt_task' => $t_task_idt_task , 
                    //     't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                    //     't_taskAssignedUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
                    //     't_taskAssignedType' => 'Realiza',
                    //     't_taskAssignedDate' => date('Y-m-d H:i:s')
                    //     ]
                    // );
                }
                $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$t_task_idt_task]);
                $taskA = DB::select("SELECT * FROM `t_generalTask` , `t_task` where `t_task`.`idt_task` = ?  AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` ", [$t_task_idt_task]);
                $obj = $taskA[0];
                return response() -> json([ 'status' => true,'id' => sha1(md5($t_task_idt_task)), 'obj' => $obj, 'taskAssigned' => $task_assigned, 'taskAssignedDefault' => Session::get('user') -> idt_usuarios]);
            
            }
            
            $task_assigned = DB::select("SELECT * , sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_task_idt_task`)) = ? ", [$request -> id]);
            $taskA = DB::select("SELECT *, (sha1(md5(t_taskDependence))) as t_taskDependence FROM `t_generalTask` , `t_task` where sha1(md5(`t_task`.`idt_task`)) = ?  AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` ", [$request -> id]);
            $obj = $taskA[0];
            return response() -> json([ 'status' => true,'id' => $request -> id, 'obj' => $obj, 'taskAssigned' => $task_assigned, 'taskAssignedDefault' => Session::get('user') -> idt_usuarios]);
        
            
        }
    }

    

    public function nif(Request $request) 
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $customer = DB::table('t_clientes')->where('t_clientesNif', strtolower($this ->changeNifNoFormat($request -> t_clientesNif_1)))->first();
            return response() -> json([ 'customer' => $customer]);
        }
    }

    public function searchCustomer(Request $request)
    {
        $request -> search = $this -> changeNifNoFormat($request -> search);
        if (isset(Session::get('user') -> idt_usuarios)) {
            $customer = DB::table('t_clientes') -> where (
                function ($query)  use ( $request ) {    
                    $query ->Where('t_clientesNombre', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesTelefono', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesEmail', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesNif', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesEmpresa', 'LIKE', '%'.$request -> search.'%');
                }
            )->get();
            //DB::raw("CONCAT(users.first_name,' ',users.last_name)

            foreach ($customer as $c) {
                $s[] = array( 'id' => $c -> idt_clientes ,'value' => $c -> t_clientesNombre.' '.$c -> t_clientesApellido, 'label' => '<strong>'.$c -> t_clientesNombre.' '.$c -> t_clientesApellido.'</strong> <br>'.($this -> changeNifFormat($c -> t_clientesNif)).'<br>'.$c -> t_clientesEmail, 'c' => $c);
            }
            if (!isset($s)) {
                return response() -> json([ 'customer' => '']);
            }
            return response() -> json([ 'customer' => $s]);
        }
    }

    public function addSubTask(Request $request)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $task =  DB::select("SELECT * FROM `t_generalTask` where sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?", [$request -> id]);
            $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE sha1(md5(`t_taskAssigned`.`t_generalTask_idt_generalTask`)) = ? ", [$request -> id]);
            $idt_generalTask = $task[0] -> idt_generalTask;
            $id = DB::table('t_task') -> insertGetId(
                [
                't_generalTask_idt_generalTask' => $idt_generalTask, 
                't_taskUserCreated' => Session::get('user') -> idt_usuarios, 
                't_taskUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
                't_taskDateCreated' => date('Y-m-d H:i:s'),
                't_taskDueDate' => $task[0] -> t_generalTaskDueDate,
                't_task_link' => $this -> generateTaskLink(),
                't_taskEnd' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($task[0] -> t_generalTaskDueDate)))
                ]
            ); 

            if ($task[0] -> t_generalTaskType != 'Project') {
                if (count($task_assigned) > 0) {
                    foreach ($task_assigned as $t_a) {
                        $id_2 = DB::table('t_taskAssigned') -> insertGetId(
                            [
                            't_task_idt_task' => $id, 
                            't_usuarios_idt_usuarios' => $t_a -> t_usuarios_idt_usuarios, 
                            't_taskAssignedUserName' => $t_a -> t_taskAssignedUserName, 
                            't_taskAssignedType' => $t_a -> t_taskAssignedType,
                            't_taskAssignedDate' => date('Y-m-d H:i:s')
                            ]
                        );

                        if ($t_a -> t_taskAssignedType == 'Valida') {
                            $affected = DB::update('UPDATE `t_generalTask` SET `t_generalTaskRequiredValidation` = 1 WHERE sha1(md5(`t_generalTask`.`idt_generalTask`)) = ?', [ $request -> id]);
                        }
                    }
                }
            }

            if ($task[0] -> t_generalTaskType == 'Meeting') {
                $documents = DB::select("SELECT * FROM `t_file_has_t_task` WHERE `t_file_has_t_task`.`t_generalTask_idt_generalTask` = ? ", [$task[0] -> idt_generalTask]);
                foreach ($documents as $d) {
                    $documents_old = DB::select("SELECT * FROM `t_file_has_t_task` WHERE `t_file_has_t_task`.`t_task_idt_task` = ? AND `t_file_has_t_task`.`t_file_idt_file` = ? ", [$id,$d -> t_file_idt_file]);
                    if (count($documents_old) > 0) {

                    } else {
                        $id_doc = DB::table('t_file_has_t_task') -> insertGetId(
                            [
                            't_task_idt_task' => $id,
                            't_file_has_t_taskId' => sha1(md5(microtime())), 
                            't_file_has_t_taskPointer' => 1,
                            't_file_idt_file' => $d -> t_file_idt_file
                            ]
                        );
                    }
                }
            }

            // $id_2 = DB::table('t_taskAssigned') -> insertGetId(
            //     [
            //     't_task_idt_task' => $id, 
            //     't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
            //     't_taskAssignedUserName' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 
            //     't_taskAssignedType' => 'Realiza',
            //     't_taskAssignedDate' => date('Y-m-d H:i:s')
            //     ]
            // );
            $task_assigned = DB::select("SELECT *, sha1(md5(t_usuarios_idt_usuarios)) as user FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ? ", [$id]);
            $taskA = DB::select("SELECT * FROM `t_generalTask` , `t_task` where `t_task`.`idt_task` = ?  AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` ", [$id]);
            $obj = $taskA[0];
            return response() -> json([ 'id' => sha1(md5($id)), 'obj' => $obj,'father' => $request -> id,'taskAssigned' => $task_assigned, 'taskAssignedDefault' => Session::get('user') -> idt_usuarios]);
            return $request;
            return response() -> json([ 'id' => 'hello']);
        }
    }

    public function sendMailAssigned($p)
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $obj_mail = new \stdClass();
            $obj_mail -> to = $p['email'];
            $obj_mail -> vista = 'mails.taskNotificationAssigned';
            $obj_mail -> p = $p;
            $obj_mail -> subject = $p['subject'];
            Mail::to($p['email'])->send(new MailA($obj_mail));
        }
    }

    public function Sustituto_Cadena($rb)
    {
        ## Sustituyo caracteres en la cadena final
        $rb = str_replace("Ã¡", "&aacute;", $rb);
        $rb = str_replace("Ã©", "&eacute;", $rb);
        $rb = str_replace("Â®", "&reg;", $rb);
        $rb = str_replace("Ã­", "&iacute;", $rb);
        $rb = str_replace("ï¿½", "&iacute;", $rb);
        $rb = str_replace("Ã³", "&oacute;", $rb);
        $rb = str_replace("Ãº", "&uacute;", $rb);
        $rb = str_replace("n~", "&ntilde;", $rb);
        $rb = str_replace("Âº", "&ordm;", $rb);
        $rb = str_replace("Âª", "&ordf;", $rb);
        $rb = str_replace("ÃƒÂ¡", "&aacute;", $rb);
        $rb = str_replace("Ã±", "&ntilde;", $rb);
        $rb = str_replace("Ã‘", "&Ntilde;", $rb);
        $rb = str_replace("ÃƒÂ±", "&ntilde;", $rb);
        $rb = str_replace("n~", "&ntilde;", $rb);
        $rb = str_replace("Ãš", "&Uacute;", $rb);
        return $rb;
    }  

    public function changeNifFormat($nif) 
    {
        $start = false;
        $end = false;

        if (strlen($nif) == 9) {
            $a=2;
           
            $nif_array = str_split($nif);
            $temp = substr($nif, 0, 1);
            if (!is_numeric($temp)) {
                $start = true;
            }

            $temp =  substr($nif, 8, 9);
            if (!is_numeric($temp)) {
                $end = true;
            }

            if ($start && $end) {
               
                $nif = $nif_array[0].$nif_array[1].'.'.$nif_array[2].$nif_array[3].$nif_array[4].'.'.$nif_array[5].$nif_array[6].$nif_array[7].'-'.$nif_array[8];
            } elseif ($start) {
                
                $nif = $nif_array[0].'-'.$nif_array[1].$nif_array[2].'.'.$nif_array[3].$nif_array[4].$nif_array[5].'.'.$nif_array[6].$nif_array[7].$nif_array[8];
            } elseif ($end) {
                
                $nif = $nif_array[0].$nif_array[1].'.'.$nif_array[2].$nif_array[3].$nif_array[4].'.'.$nif_array[5].$nif_array[6].$nif_array[7].'-'.$nif_array[8];
            }
        } 
         
        return $nif;
    }

    public function changeNifNoFormat($nif) 
    {
        
        $nif = str_replace(".", "", $nif);
        $nif = str_replace("-", "", $nif);
        
        return $nif;

    }

}
