package com.example.sugarcane.profil;

import com.google.gson.annotations.SerializedName;

public class UpdateProfile {

    @SerializedName("data")
    private ProfileData profileData;

    @SerializedName("error")
    private Boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    public ProfileData getProfileData() {
        return profileData;
    }

    public void setProfileData(ProfileData profileData) {
        this.profileData = profileData;
    }

    public Boolean getError() {
        return error;
    }

    public void setError(Boolean error) {
        this.error = error;
    }

    public String getError_msg() {
        return error_msg;
    }

    public void setError_msg(String error_msg) {
        this.error_msg = error_msg;
    }

}
