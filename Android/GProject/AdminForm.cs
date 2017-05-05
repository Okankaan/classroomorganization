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

namespace GProject
{
    [Activity(Theme = "@android:style/Theme.Black.NoTitleBar.Fullscreen")]
    public class AdminForm :Activity
    {
        private Button btn_AddUser, btn_ShowUsers;
        private TextView lbl_UserIDAdmin, lbl_UserName, lbl_Surname;
        protected override void OnCreate(Bundle bundle)
        {
            base.OnCreate(bundle);
            SetContentView(Resource.Layout.Admin_Form);
            btn_AddUser = FindViewById<Button>(Resource.Id.btnAddUser);
            btn_ShowUsers = FindViewById<Button>(Resource.Id.btnShowUsers);
            lbl_UserIDAdmin = FindViewById<TextView>(Resource.Id.lblUserIdAdmin);

            lbl_UserName = FindViewById<TextView>(Resource.Id.lblUserNameA);
            lbl_Surname = FindViewById<TextView>(Resource.Id.lblUserSurnameA);

            lbl_UserName.Text = LoginForm.lusername;
            lbl_Surname.Text = LoginForm.lusersurname;

            lbl_UserIDAdmin.Text = LoginForm.txt_User.Text;
            btn_AddUser.Click += Btn_AddUser_Click;
            btn_ShowUsers.Click += Btn_ShowUsers_Click;
        }

        private void Btn_ShowUsers_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(AdminFormShow));
            StartActivity(intent);
        }

        private void Btn_AddUser_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(AdminFormADD));
            StartActivity(intent);
        }
    }
}

