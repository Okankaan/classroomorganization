using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Util;
using Android.Views;
using Android.Widget;
using System.Net;
using System.Collections.Specialized;
using Newtonsoft.Json.Linq;
using System.Security.Cryptography;

namespace GProject
{
    [Activity(Label = "Add User", ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]

    public class AdminFormADD : Activity    
    {
        private EditText txt_Name, txt_Surname, txt_password, txt_emailadress, txt_recoveryemail,txt_NewID;
        private Spinner combo_Type, combo_FacultyName;
        string[] type,facultynames;
        private ArrayAdapter adapter;
        private Button btn_AddUser;
        LinearLayout faculty_Layout;
        Toast tst;
        protected override void OnCreate(Bundle bundle)
        {
            base.OnCreate(bundle);
            SetContentView(Resource.Layout.Admin_Form_ADD);

            txt_Name = FindViewById<EditText>(Resource.Id.txtNewName);
            txt_Surname = FindViewById<EditText>(Resource.Id.txtNewSurname);
            txt_password = FindViewById<EditText>(Resource.Id.txtNewPassword);
            txt_emailadress = FindViewById<EditText>(Resource.Id.txtNewEmailddres);
            txt_recoveryemail = FindViewById<EditText>(Resource.Id.txtNewRecoveryEmailAdress);
            txt_NewID = FindViewById<EditText>(Resource.Id.txtNewID);
            faculty_Layout = FindViewById<LinearLayout>(Resource.Id.facultyLayout);

            btn_AddUser = FindViewById<Button>(Resource.Id.btnAddUser);

            combo_Type = FindViewById<Spinner>(Resource.Id.comboNewType);
            txt_NewID.TextChanged += Txt_NewID_TextChanged;
            combo_FacultyName = FindViewById<Spinner>(Resource.Id.comboNewFacultyName);

            faculty_Layout.Alpha = 0;
            txt_emailadress.TextChanged += Txt_emailadress_TextChanged;
            txt_recoveryemail.TextChanged += Txt_recoveryemail_TextChanged;
            type = new string[3] { "Administor", "Rectorate Staff", "Faculty Staff" };
            adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, type);
            combo_Type.Adapter = adapter;

            combo_Type.ItemSelected += Combo_Type_ItemSelected;
            btn_AddUser.Click += Btn_AddUser_Click;
        }

        private void Txt_recoveryemail_TextChanged(object sender, Android.Text.TextChangedEventArgs e)
        {
            if (tst != null)
                tst.Cancel();
            WebClient userRecEmailCheck = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_userREmail.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("urecemail", txt_recoveryemail.Text);
            userRecEmailCheck.UploadValuesCompleted += UserRecEmailCheck_UploadValuesCompleted;
            userRecEmailCheck.UploadValuesTaskAsync(url, parameters);
        }

        private void UserRecEmailCheck_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                string json = "";
                try { json = Encoding.UTF8.GetString(e.Result); }
                catch
                {
                      tst = Toast.MakeText(this, "Connection Failed", ToastLength.Long);
                    tst.Show();
                    return;
                }
                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {

                    foreach (JProperty p in o.Properties())
                    {
                        if ((string)p.Value == "0")
                        {
                            btn_AddUser.Alpha = 0;
                            tst = Toast.MakeText(this, "User Recovery E-mail Address Already Exist", ToastLength.Long);
                            tst.Show();
                        }
                        else if ((string)p.Value == "1")
                            btn_AddUser.Alpha = 1;
                    }
                }
                return;
            });
        }

        private void Txt_emailadress_TextChanged(object sender, Android.Text.TextChangedEventArgs e)
        {
            if (tst != null)
                tst.Cancel();
            WebClient userEmailCheck = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_userEmail.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("uemail", txt_emailadress.Text);
            userEmailCheck.UploadValuesCompleted += UserEmailCheck_UploadValuesCompleted;
            userEmailCheck.UploadValuesTaskAsync(url, parameters);
        }

        private void UserEmailCheck_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                string json = "";
                try { json = Encoding.UTF8.GetString(e.Result); }
                catch
                {
                    tst = Toast.MakeText(this, "Connection Failed", ToastLength.Long);
                    tst.Show();
                    return;
                }
                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {

                    foreach (JProperty p in o.Properties())
                    {
                        if ((string)p.Value == "0")
                        {
                            btn_AddUser.Alpha = 0;
                            tst = Toast.MakeText(this, "User E-mail Address Already Exist", ToastLength.Long);
                            tst.Show();
                        }
                        else if ((string)p.Value == "1")
                            btn_AddUser.Alpha = 1;
                    }
                }
                return;
            });
        }

        private void Txt_NewID_TextChanged(object sender, Android.Text.TextChangedEventArgs e)
        {
            if(tst!=null)
            tst.Cancel();
            WebClient userIDcheck = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_userID.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("uID", txt_NewID.Text);
            userIDcheck.UploadValuesCompleted += UserIDcheck_UploadValuesCompleted;
            userIDcheck.UploadValuesTaskAsync(url, parameters);
        }
        private void UserIDcheck_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                string json = "";
                try { json = Encoding.UTF8.GetString(e.Result); }
                catch
                {
                    tst = Toast.MakeText(this, "Connection Failed", ToastLength.Long);
                    tst.Show();
                    return;
                }
                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {

                    foreach (JProperty p in o.Properties())
                    {
                        if ((string)p.Value == "0")
                        {
                            btn_AddUser.Alpha = 0;
                            tst = Toast.MakeText(this, "User ID Already Exist", ToastLength.Long);
                            tst.Show();
                        }
                        else if ((string)p.Value == "1")
                            btn_AddUser.Alpha = 1;
                    }
                }
                return;
            });
        }
        void vfaculty()
        {
            if (tst != null)
                tst.Cancel();
            WebClient client2 = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_faculties.php");
            NameValueCollection parameters = new NameValueCollection();
            client2.UploadValuesCompleted += Client2_UploadValuesCompleted;
            client2.UploadValuesTaskAsync(url, parameters);

        }
        private void Client2_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                int r=0;
                string json = "";
                try { json = Encoding.UTF8.GetString(e.Result); }
                catch
                {
                    Toast.MakeText(this, "Connection Failed", ToastLength.Long).Show();
                    return;
                }

                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {
                    
                    foreach (JProperty p in o.Properties())
                    {
                        
                    }
                    r++;
                }
                facultynames = new string[r];

                for (int i = 0; i < r; i++)
                    facultynames[i] = "";

                r = 0;
                foreach (JObject o in a.Children<JObject>())
                {
                    
                    foreach (JProperty p in o.Properties())
                    {
                        facultynames[r] = (string)p.Value;
                    }
                    r++;
                }
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, facultynames);
                combo_FacultyName.Adapter = adapter;
                return;
            });
        }
        private void Btn_AddUser_Click(object sender, EventArgs e)
        {
            if (txt_NewID.Text != "" && txt_Name.Text != "" && txt_Surname.Text != "" && txt_password.Text != "" && txt_emailadress.Text != "" && txt_recoveryemail.Text != "")
            {
                SHA256 encrypPass = SHA256.Create();
                byte[] data = encrypPass.ComputeHash(Encoding.Default.GetBytes(txt_password.Text));
                StringBuilder sBuilder = new StringBuilder();

                for (int i = 0; i < data.Length; i++)
                { sBuilder.Append(data[i].ToString("x2")); }

                WebClient client = new WebClient();
                Uri url = new Uri("http://n00ne.xyz/xamarin_AddUser.php");
                NameValueCollection parameters = new NameValueCollection();
                parameters.Add("nID", txt_NewID.Text);
                parameters.Add("nname", txt_Name.Text);
                parameters.Add("nsurname", txt_Surname.Text);
                parameters.Add("npassword", sBuilder.ToString());
                parameters.Add("nemail", txt_emailadress.Text);
                parameters.Add("nrecoveryemail", txt_recoveryemail.Text);

                if (combo_Type.SelectedItem.ToString() == "Administor")
                {
                    parameters.Add("ntype", "1");
                    parameters.Add("nfaculty", "0");
                }
                else if (combo_Type.SelectedItem.ToString() == "Rectorate Staff")
                {
                    parameters.Add("ntype", "2");
                    parameters.Add("nfaculty", "-1");
                }
                else if (combo_Type.SelectedItem.ToString() == "Faculty Staff")
                {
                    parameters.Add("ntype", "3");
                    parameters.Add("nfaculty", combo_FacultyName.SelectedItem.ToString());
                }
                client.UploadValuesCompleted += Client_UploadValuesCompleted;
                client.UploadValuesTaskAsync(url, parameters);
            }
            else
            {
                tst = Toast.MakeText(this, "Please Fill Blank(s)", ToastLength.Long);
                tst.Show();
            }

        }
        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                string json = "";
                try {  json = Encoding.UTF8.GetString(e.Result); }
                catch
                {
                    Toast.MakeText(this, "Connection Failed", ToastLength.Long).Show();
                    return; }
                
                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        if((string)p.Value=="1")
                        {
                            Toast.MakeText(this, "User Added", ToastLength.Long).Show();
                            txt_NewID.Text = "";
                            txt_Name.Text = "";
                            txt_Surname.Text = "";
                             txt_password.Text = "";
                             txt_emailadress.Text = "";
                             txt_recoveryemail.Text = "";

                        }
                        else
                            Toast.MakeText(this, "User Adding Failed", ToastLength.Long).Show();
                    }
                }
                return;
            });
        }
        private void Combo_Type_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            if (combo_Type.SelectedItem.ToString() == "Faculty Staff")
            {
                vfaculty();
                faculty_Layout.Alpha = 1;
            }
            else
            {
                faculty_Layout.Alpha = 0;
            }
        }
    }
}