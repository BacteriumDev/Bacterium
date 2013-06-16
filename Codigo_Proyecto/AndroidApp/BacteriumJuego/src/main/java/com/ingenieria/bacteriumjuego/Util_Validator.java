package com.ingenieria.bacteriumjuego;

import android.widget.EditText;

/**
 * Created by Roberto on 15/06/13.
 */
public class Util_Validator {

    public Util_Validator(){}

    public boolean password_validate(EditText password)
    {
        boolean error = false;
        if(!password.getText().toString().equals(""))
        {
            if(password.getText().toString().length() < 5)
            {
                error = true;
                password.setError("Muy pocos caracteres");
            }else if(password.getText().toString().contains("'"))
            {
                error = true;
                password.setError("Caracteres invalidos");
            }
        }else
        {
            error = true;
            password.setError("Datos incompletos");
        }
        return error;
    }

    public boolean username_validate(EditText username)
    {
        boolean error = false;
        if(!username.getText().toString().equals(""))
        {
            if(username.getText().toString().length() < 6)
            {
                error = true;
                username.setError("Usuario inválido");
            }else if(username.getText().toString().contains("'"))
            {
                error = true;
                username.setError("Caracteres invalidos");
            }
        }else
        {
            error = true;
            username.setError("Datos incompletos");
        }

        return error;
    }

}
