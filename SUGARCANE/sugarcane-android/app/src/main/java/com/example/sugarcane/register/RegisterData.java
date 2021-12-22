package com.example.sugarcane.register;

import com.google.gson.annotations.SerializedName;

public class RegisterData {
    @SerializedName("id_user")
    public int id_user;
    @SerializedName("username")
    public String username;
    @SerializedName("password")
    public String password;
    @SerializedName("fullname")
    public String fullname;
    @SerializedName("alamat")
    public String alamat;
    @SerializedName("no_hp")
    public String no_hp;
    @SerializedName("foto")
    public String foto;

    public RegisterData (int id_user, String username, String password, String fullname,
                 String alamat, String no_hp, String foto) {

        this.id_user = id_user;
        this.username = username;
        this.password = password;
        this.fullname = fullname;
        this.alamat = alamat;
        this.no_hp = no_hp;
        this.foto = foto;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getFullname() {
        return fullname;
    }

    public void setFullname(String fullname) {
        this.fullname = fullname;
    }

    public String getAlamat() {
        return alamat;
    }

    public void setAlamat(String alamat) {
        this.alamat = alamat;
    }

    public String getNo_hp() {
        return no_hp;
    }

    public void setNo_hp(String no_hp) {
        this.no_hp = no_hp;
    }

    public String getFoto() {
        return foto;
    }

    public void setFoto(String foto) {
        this.foto = foto;
    }
}
