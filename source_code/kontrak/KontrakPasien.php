<?php

interface KontrakPasienView
{
    public function tampilTabel();
    public function tampilAdd();
    public function tampilEdit($id);
    public function add($data);
    public function edit($data);
    public function delete($id);
}

interface KontrakPasienPresenter
{
    public function prosesDataPasien();
    public function getDataPasienById($id);
    public function add($data);
    public function edit($data);
    public function delete($id);
    public function getId($i);
    public function getNik($i);
    public function getNama($i);
    public function getTempat($i);
    public function getTl($i);
    public function getGender($i);
    public function getEmail($i);
    public function getTelp($i);
    public function getSize();
}
