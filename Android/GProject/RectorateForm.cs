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
    [Activity(Theme = "@android:style/Theme.Black.NoTitleBar.Fullscreen")]

    class RectorateForm : Activity
    {
        private Button btn_ClassSearchR,btn_TimeSearchR,btn_EmptySearchR,btn_CourseSearchR;
        private TextView lbl_UserIDMenuR, lbl_UserName, lbl_Surname;

        public int Txt_User_Click { get; private set; }

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Rectorate_Form);

            btn_ClassSearchR = FindViewById<Button>(Resource.Id.btnClassBasedSearchR);
            btn_TimeSearchR = FindViewById<Button>(Resource.Id.btnTimeSearchR);
            btn_EmptySearchR = FindViewById<Button>(Resource.Id.btnEmptySearchR);
            btn_CourseSearchR = FindViewById<Button>(Resource.Id.btnCourseSearchR);
            lbl_UserIDMenuR = FindViewById<TextView>(Resource.Id.lblUserIDMenuR);

            lbl_UserName = FindViewById<TextView>(Resource.Id.lblUserNameR);
            lbl_Surname = FindViewById<TextView>(Resource.Id.lblUserSurnameR);

            

            lbl_UserIDMenuR.Text = LoginForm.txt_User.Text;
            btn_ClassSearchR.Click += Btn_ClassSearchR_Click;
            btn_TimeSearchR.Click += Btn_TimeSearchR_Click;
            btn_EmptySearchR.Click += Btn_EmptySearchR_Click;
            btn_CourseSearchR.Click += Btn_CourseSearchR_Click;
            lbl_UserName.Text = LoginForm.lusername;
            lbl_Surname.Text = LoginForm.lusersurname;
        }

        private void Btn_CourseSearchR_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableCourseR));
            StartActivity(intent);
        }


        private void Btn_EmptySearchR_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableEmptyR));
            StartActivity(intent);
        }

        private void Btn_TimeSearchR_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableDayTimeR));
            StartActivity(intent);
        }

        private void Btn_ClassSearchR_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableClassR));
            StartActivity(intent);
        }
    }
}