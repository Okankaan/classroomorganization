using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using System.Net;
using System.Collections.Specialized;
using Newtonsoft.Json.Linq;

namespace GProject
{
    [Activity(Theme = "@android:style/Theme.Black.NoTitleBar.Fullscreen")]
    class ForgotForm : Activity 
    {
        public Button btn_SendMail;
        public EditText txt_UserEmailAdress;
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Forgot_Form);
            txt_UserEmailAdress = FindViewById<EditText>(Resource.Id.txtUserEmail);
            btn_SendMail = FindViewById<Button>(Resource.Id.btnSendMail);

            btn_SendMail.Click += Btn_SendMail_Click;
        }

        public void Btn_SendMail_Click(object sender, EventArgs e)
        {

            if (txt_UserEmailAdress.Text == "")
            {
                Toast.MakeText(this, "Please Enter User E-mail Adress", ToastLength.Long).Show();
            }
            else
            {

                WebClient client = new WebClient();
                Uri url = new Uri("http://n00ne.xyz/xamarin_forgotsendmail.php");
                NameValueCollection parameters = new NameValueCollection();
                parameters.Add("uemail", txt_UserEmailAdress.Text);
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
                }
                JArray a = JArray.Parse(json);


                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        if ((string)p.Value == "3")
                        {
                            Toast.MakeText(this, "User ID Does Not Exist", ToastLength.Long).Show();
                        }
                        else if ((string)p.Value == "0")
                        {
                            Toast.MakeText(this, "Connection Failed", ToastLength.Long).Show();
                        }
                        else
                        {
                            
                                Toast.MakeText(this, "E-Mail Sended\nPlease Check Your Recovery E-Mail\n"+p.Value+"", ToastLength.Long).Show();

                        }
                    }
                }
            });
        }
    }
}