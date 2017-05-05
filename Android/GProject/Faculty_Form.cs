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
    class Faculty_Form : Activity
    {
        GridView grV;
        ArrayList arrl;
        ArrayAdapter adapter;
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Faculty_Form);
            grV = FindViewById<GridView>(Resource.Id.gridView1);
        }
        void gridView ()
        {
            arrl = new ArrayList();
            try
            {
                MySqlCommand cmd = new MySqlCommand("SELECT name,pw,user_type,e_mail FROM plastwin_db.users", LoginForm.conn);
                MySqlDataReader dr = cmd.ExecuteReader();
                arrl.Add("Name");
                arrl.Add("Password");
                arrl.Add("User Type");
                arrl.Add("Email");
                while (dr.Read())
                {
                    arrl.Add(dr[0].ToString());
                    arrl.Add(dr[1].ToString());
                    arrl.Add(dr[2].ToString());
                    arrl.Add(dr[3].ToString());
                }
                dr.Close();
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleListItem1, arrl);
                grV.Adapter = adapter;
            }
            catch { }
        }
    }
}