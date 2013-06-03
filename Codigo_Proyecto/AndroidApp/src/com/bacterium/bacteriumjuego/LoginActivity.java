package com.bacterium.bacteriumjuego;

import android.app.Activity;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import android.view.View.OnClickListener;

public class LoginActivity extends Activity{

	EditText edusername;
	EditText edpassword;
	Button btnlogin;
	WebServiceConnector ws;
	
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		setContentView(R.layout.activity_login);
		
		edusername = (EditText) findViewById(R.id.et_un);
		edpassword = (EditText) findViewById(R.id.et_pw);
		btnlogin = (Button) findViewById(R.id.btn_login);
		btnlogin.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Login();
			}
		});
	}
	
	
	private void Login()
	{
		String un = edusername.getText().toString();
		String pw = edpassword.getText().toString();
		String wsmessage = "A||"+un+"||"+pw;
		Log.d("MSG", wsmessage);
		ws = new WebServiceConnector();
		String wsresponse = ws.getResponse(wsmessage);
		Toast.makeText(this, wsresponse, Toast.LENGTH_LONG).show();
/*		if(wsresponse == "Aprobado")
		{
			Toast.makeText(this, "Usuario correcto", Toast.LENGTH_LONG).show();			
		}else
		{
			Toast.makeText(this, "Usuario incorrecto", Toast.LENGTH_LONG).show();			
		}
	*/	
	
	}
	
	
}
