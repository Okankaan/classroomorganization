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
using System.Collections;
using MySql.Data.MySqlClient;

namespace GProject
{
    class MenuForm : Activity
    {
        Button btn_List;

        public int Txt_User_Click { get; private set; }

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Menu_Form);
            btn_List = FindViewById<Button>(Resource.Id.button1);
            btn_List.Click += Btn_List_Click;
        }

        private void Btn_List_Click(object sender, EventArgs e)
        {
            
        }
    }
}