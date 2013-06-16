package com.ingenieria.bacteriumjuego;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends Activity {

    EditText username;
    EditText password;
    Button btnlogin;
    Util_ActionBar actionbar;
    WebServiceConnector ws;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
        setContentView(R.layout.activity_login);

        username = (EditText) findViewById(R.id.etusername);
        password = (EditText) findViewById(R.id.etpassword);
        btnlogin = (Button) findViewById(R.id.btn_login);
        btnlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                login();
            }
        });

        actionbar = (Util_ActionBar) findViewById(R.id.utilsactionBarLogin);
        actionbar.setTitle("Login - Bacterium");

    }

    private void login()
    {
        Util_Validator validator = new Util_Validator();
        boolean validated = (!validator.username_validate(username) && !validator.password_validate(password));
        if(validated)
        {
            String un = username.getText().toString();
            String pw = password.getText().toString();
            String wsmessage = "A||"+un+"||"+pw;
            Log.d("MSG", wsmessage);
            ws = new WebServiceConnector();
            String wsresponse = ws.getResponse(wsmessage);
            //Toast.makeText(this, wsresponse, Toast.LENGTH_LONG).show();
            if(wsresponse.equals("Aprobado"))
            {
                try{
                    Intent intent;
                    intent = new Intent(this, HomeActivity.class);
                    startActivity(intent);
                    finish();
                }catch(Exception w)
                {
                    Log.d("Error", w.getMessage());
                }
            }else if(wsresponse.equals("Rechazado"))
            {
                Toast.makeText(this, "Datos incorrectos", Toast.LENGTH_LONG).show();
            }else
            {
                Toast.makeText(this, "Server internal error, check connection", Toast.LENGTH_LONG).show();
            }
        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.login, menu);
        return true;
    }
    
}
