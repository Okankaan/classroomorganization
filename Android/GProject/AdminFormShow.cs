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
using System.Collections;

namespace GProject
{
    [Activity(Label = "Show Users", ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]
    class AdminFormShow : Activity
    {
        private Spinner combo_Users;
        private ArrayAdapter adapter;
        private ArrayList aclassesname;
        private EditText txtsearch_Name;
        private LinearLayout faculty_layout;
        private string facultyid;
        private TextView uid, uname, usurname, utype, uemail, urecemail, ufaculty;
        protected override void OnCreate(Bundle savedInstanceState)
        {

            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Admin_Form_Show);
           
            txtsearch_Name = FindViewById<EditText>(Resource.Id.txtSearchName);
            combo_Users = FindViewById<Spinner>(Resource.Id.comboUsers);
            users();
            uid = FindViewById<TextView>(Resource.Id.lblUserID);
            uname = FindViewById<TextView>(Resource.Id.lblUserName);
            usurname = FindViewById<TextView>(Resource.Id.lblUserSurname);
            utype = FindViewById<TextView>(Resource.Id.lblUserType);
            uemail = FindViewById<TextView>(Resource.Id.lblUserEmail);
            urecemail = FindViewById<TextView>(Resource.Id.lblUserRecEmail);
            ufaculty = FindViewById<TextView>(Resource.Id.lblUserFaculty);
            faculty_layout = FindViewById<LinearLayout>(Resource.Id.facultyLayout);
            txtsearch_Name.TextChanged += Txtsearch_Name_TextChanged;
            combo_Users.ItemSelected += Combo_Users_ItemSelected;
        }

        private void Combo_Users_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
             
                WebClient client2 = new WebClient();
                Uri url = new Uri("http://n00ne.xyz/xamarin_users.php");
                NameValueCollection parameters = new NameValueCollection();
                parameters.Add("uname", combo_Users.SelectedItem.ToString());
                client2.UploadValuesCompleted += Client2_UploadValuesCompleted;
                client2.UploadValuesTaskAsync(url, parameters);
            
        }
        private void Client2_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                    uid.Text = "";
                uname.Text = "";
                usurname.Text = "";
                utype.Text = "";
                uemail.Text = "";
                urecemail.Text = "";
                ufaculty.Text = "";
                faculty_layout.Alpha = 0;
                string json = "";
                try
                {
                    json = Encoding.UTF8.GetString(e.Result);
                }
                catch { Toast.MakeText(this, "Please Check Connection", ToastLength.Long).Show(); }
                JArray a = JArray.Parse(json);
                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        if ((string)p.Name == "ID")
                            uid.Text = (string)p.Value;
                        if ((string)p.Name == "u_name")
                            uname.Text = (string)p.Value;
                        if ((string)p.Name == "surname")
                            usurname.Text = (string)p.Value;
                        if ((string)p.Name == "user_type")
                        {
                            utype.Text = (string)p.Value;
                            if (utype.Text == "3")
                                utype.Text = "Faculty Staff";
                            else if (utype.Text == "2")
                                utype.Text = "Rectorate Staff";
                            else if (utype.Text == "1")
                                utype.Text = "Administor";
                        }
                        if ((string)p.Name == "e_mail")
                            uemail.Text = (string)p.Value;
                        if ((string)p.Name == "recovery_email")
                            urecemail.Text = (string)p.Value;
                        if ((string)p.Name == "f_name")
                            ufaculty.Text = (string)p.Value;

                        if ((string)p.Name == "faculty")
                        {
                            facultyid = (string)p.Value;
                            if(utype.Text == "Faculty Staff")
                                userfaculty();
                        }
                    }
                }
                return;
            });
        }
        private void Txtsearch_Name_TextChanged(object sender, Android.Text.TextChangedEventArgs e)
        {
            combo_Users.Adapter = null;
            users();
        }
        void users()
        {
            combo_Users.Adapter = null;
            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_users.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("uname", txtsearch_Name.Text);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);  
        }
        void userfaculty()
        {
            WebClient ufacultyname = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_userfaculty.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("facultyid", facultyid);
            ufacultyname.UploadValuesCompleted += Ufacultyname_UploadValuesCompleted;
            ufacultyname.UploadValuesTaskAsync(url, parameters);
        }

        private void Ufacultyname_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
              
                string json = "";
                try
                {
                    json = Encoding.UTF8.GetString(e.Result);
                }
                catch { Toast.MakeText(this, "Please Check Connection", ToastLength.Long).Show(); }

                        faculty_layout.Alpha = 1;
                ufaculty.Text = json;
                
                return;
            });
        }

        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {            
            RunOnUiThread(() =>
            {
                aclassesname = new ArrayList();
                aclassesname.Clear();
                string json = "";
                try
                {
                     json = Encoding.UTF8.GetString(e.Result);
                }
                catch { Toast.MakeText(this, "Please Check Connection", ToastLength.Long).Show(); }
                JArray a = JArray.Parse(json);
                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        if ((string)p.Name == "u_name")
                        {
                            string value = (string)p.Value;
                            aclassesname.Add(value);
                        }
                    }
                }
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, aclassesname);
                combo_Users.Adapter = adapter;
                return;
            });
        }
    }
}