<?php

class User_model extends CI_Model
{
    private $_table = "user";

    public function doLogin(){
		$post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('email', $post["email"]);
        $user = $this->db->get($this->_table)->row();
        // jika user terdaftar
        if($user){
          // $pass = $this->all_library->encodeString($post['password']);
          $pass = $this->all_library->decodeString($user->password);
            // periksa password-nya
            $isPasswordTrue = ($pass == $post['password']) ? true : false;
            // periksa role-nya
            $isAdmin = $user->nama == "Admin";
            $isMarketing = $user->nama == "Marketing";

            // jika password benar dan dia admin
            if($isPasswordTrue && ($isAdmin || $isMarketing)){
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                return true;
            }
        }

        // login gagal
		return false;
    }

    public function isNotLogin(){
        print_r($this->session->userdata('user_logged'));
        return $this->session->userdata('user_logged') === null;
    }

}
