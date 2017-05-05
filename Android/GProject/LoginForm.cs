using Android.App;
using Android.Widget;
using Android.OS;
using System.Collections.Generic;
using MySql.Data.MySqlClient;
using System.Data;
using Android.Views;
using System.Collections;
using System;
using System.Net;
using Newtonsoft.Json;
using System.Collections.Specialized;
using System.Text;
using System.Net.Http;
using Java.IO;
using Org.Apache.Http.Impl.Client;
using Org.Apache.Http.Client.Methods;
using Org.Json;
using System.IO;
using Newtonsoft.Json.Linq;
using Android.Content.Res;
using Android.Content;
using System.Security.Cryptography;
using Android.Graphics;
using Android.Webkit;

namespace GProject
{
    [Activity(MainLauncher = true, Theme = "@android:style/Theme.Black.NoTitleBar.Fullscreen")]
    public class LoginForm :Activity
    {
        public static string pass, faculty,usertype, succes,facultyname, lusername, lusersurname;
        public static EditText txt_User, txt_Password;

        private Button btn_Login;  
        private TextView lbl_Forgot;
        protected override void OnCreate(Bundle bundle)
        {
            base.OnCreate(bundle);
            SetContentView(Resource.Layout.Login_Form);

            btn_Login = FindViewById<Button>(Resource.Id.btnLogin);
            txt_User = FindViewById<EditText>(Resource.Id.txtUserID);
            txt_Password = FindViewById<EditText>(Resource.Id.txtPassword);
            lbl_Forgot = FindViewById<TextView>(Resource.Id.lblForgot);
            txt_Password.TextChanged += Txt_Password_TextChanged;
            btn_Login.Click += Btn_Login_Click;
            lbl_Forgot.Click += Lbl_Forgot_Click;
        }

        private void Txt_Password_TextChanged(object sender, Android.Text.TextChangedEventArgs e)
        {
            txt_Password.InputType = Android.Text.InputTypes.TextVariationPassword |
                           Android.Text.InputTypes.ClassText;
        }

        private void Lbl_Forgot_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(ForgotForm));
            StartActivity(intent);
        }

        private void Btn_Login_Click(object sender, EventArgs e)
        {
            if (txt_User.Text == "" && txt_Password.Text == "")
            {
                Toast.MakeText(this, "Please Fill Blank(s)", ToastLength.Long).Show();
                btn_Login.Text = "Login";
            }
            else
            {
                    btn_Login.Text = "Loading . . .";
                    SHA256 encrypPass = SHA256.Create();
                    byte[] data = encrypPass.ComputeHash(Encoding.Default.GetBytes(txt_Password.Text));
                    StringBuilder sBuilder = new StringBuilder();

                    for (int i = 0; i < data.Length; i++)
                    { sBuilder.Append(data[i].ToString("x2")); }

                    WebClient client = new WebClient();
                    Uri url = new Uri("http://n00ne.xyz/xamarin_login.php");
                    NameValueCollection parameters = new NameValueCollection();
                    parameters.Add("e_mail", txt_User.Text);
                    parameters.Add("pw", sBuilder.ToString());
                    client.UploadValuesCompleted += Client_UploadValuesCompleted;
                    client.UploadValuesTaskAsync(url, parameters);
               
            }
        }

        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {

            RunOnUiThread(() =>
            {
                string json = "";
                try
                {
                    json = Encoding.UTF8.GetString(e.Result);
                }
                catch
                {
                    Toast.MakeText(this, "Please Check Connection", ToastLength.Long).Show();
                    btn_Login.Text = "Login";
                    return;
                }
                JArray a = JArray.Parse(json);
                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        if (p.Name == "Success")
                        { succes = (string)p.Value; }
                        if (p.Name == "UserType")
                        { usertype = (string)p.Value; }
                        if (p.Name == "Faculty")
                        { faculty = (string)p.Value; }
                        if (p.Name == "FacultyName")
                        { facultyname = (string)p.Value; }
                        if (p.Name == "UserName")
                        { lusername = (string)p.Value; }
                        if (p.Name == "Usurname")
                        { lusersurname = (string)p.Value; }

                    }
                }
                if (succes == "2")
                {
                    Toast.MakeText(this, "Password is Wrong", ToastLength.Long).Show();
                    btn_Login.Text = "Login";

                    return;
                }
                else if (succes == "3")
                {
                    Toast.MakeText(this, "User ID Does Not Exist", ToastLength.Long).Show();
                    btn_Login.Text = "Login";

                    return;
                }
                else if (succes == "0")
                {
                    Toast.MakeText(this, "Connection Failed", ToastLength.Long).Show();
                    btn_Login.Text = "Login";

                    return;
                }
                else if (succes == "1")
                {
                    
                    if (faculty == "0")
                    {
                        Intent intent = new Intent(this, typeof(AdminForm));
                        StartActivity(intent);
                    }
                    else if (faculty == "-1")
                    {
                        Intent intent = new Intent(this, typeof(RectorateForm));
                        StartActivity(intent);
                    }
                    else 
                    {
                        Intent intent = new Intent(this, typeof(FacultyForm));
                        StartActivity(intent);
                    }
                }
                btn_Login.Text = "Login";
            });
        }
    }
}

