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
    [Activity(Label = "Menu Form", Theme = "@android:style/Theme.Black.NoTitleBar.Fullscreen")]

    class FacultyForm : Activity
    {
        private Button btn_ClassSearch,btn_TimeSearch,btn_EmptySearch,btn_CourseSearch;
        private TextView lbl_UserIDMenu, lbl_FacultyName,lbl_UserName,lbl_Surname;

        public int Txt_User_Click { get; private set; }

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Faculty_Form);
            btn_ClassSearch = FindViewById<Button>(Resource.Id.btnClassSearch);
            btn_CourseSearch = FindViewById<Button>(Resource.Id.btnCourseSearch);

            btn_TimeSearch = FindViewById<Button>(Resource.Id.btnTimeSearch);

            btn_EmptySearch = FindViewById<Button>(Resource.Id.btnEmptySearch);
            lbl_UserIDMenu = FindViewById<TextView>(Resource.Id.lblUserIDMenu);
            lbl_FacultyName = FindViewById<TextView>(Resource.Id.lblUserFacultyName);

            lbl_UserName = FindViewById<TextView>(Resource.Id.lblUserNameF);
            lbl_Surname = FindViewById<TextView>(Resource.Id.lblUserSurnameF);

            lbl_UserName.Text = LoginForm.lusername;
            lbl_Surname.Text = LoginForm.lusersurname;

            lbl_UserIDMenu.Text = LoginForm.txt_User.Text;
            lbl_FacultyName.Text = LoginForm.facultyname;

            btn_TimeSearch.Click += Btn_TimeSearch_Click;
            btn_ClassSearch.Click += Btn_ClassSearch_Click;
            btn_CourseSearch.Click += Btn_CourseSearch_Click;
            btn_EmptySearch.Click += Btn_EmptySearch_Click;
        }

        private void Btn_TimeSearch_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableDayTime));
            StartActivity(intent);
        }

        private void Btn_EmptySearch_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableEmpty));
            StartActivity(intent);
        }

        private void Btn_CourseSearch_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableCourse));
            StartActivity(intent);
        }

        private void Btn_ClassSearch_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(this, typeof(TimeTableClass));
            StartActivity(intent);

        }
    }
}