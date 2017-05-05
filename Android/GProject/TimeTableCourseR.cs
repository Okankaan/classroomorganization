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
using Newtonsoft.Json.Linq;
using System.Net;
using System.IO;
using System.Collections.Specialized;

namespace GProject
{
    [Activity(Label = "Course Based Search", ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]
    class TimeTableCourseR: Activity
    {
        private string[,] acoruses;
        private ArrayList combocourses;
        private ArrayAdapter adapter;
        private Spinner combo_CourseSearch;
        private GridView grid_Course;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            
            SetContentView(Resource.Layout.Time_TableCourseR);
            combo_CourseSearch = FindViewById<Spinner>(Resource.Id.comboCourseSearchR);
            grid_Course = FindViewById<GridView>(Resource.Id.gridCourseR);
            courses();
            combo_CourseSearch.ItemSelected += Combo_CourseSearch_ItemSelected;
          
            base.OnCreate(savedInstanceState);
        }


        private void Combo_CourseSearch_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_facultycourse.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("course", combo_CourseSearch.SelectedItem.ToString());
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }

        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            int r = 0;
            RunOnUiThread(() =>
            {
                string json = "";
                try
                {
                     json = Encoding.UTF8.GetString(e.Result);
                }
                catch { return; }

                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {
                    r++;
                    foreach (JProperty p in o.Properties())
                    {

                    }
                }
                acoruses = new string[r, 5];
                for (int i = 0; i <r; i++)
                {
                    for (int j = 0; j < 5; j++)
                        acoruses[i, j] = "";
                }
                r=0;
                foreach (JObject o in a.Children<JObject>())
                {

                    foreach (JProperty p in o.Properties())
                    {
                        if (p.Name == "class_no")

                            acoruses[r, 0] = (string)p.Value;

                        if (p.Name == "day_name")
                            acoruses[r, 1] = (string)p.Value;

                        if (p.Name == "ts_duration")
                            acoruses[r, 2] = (string)p.Value;

                        if (p.Name == "duration")
                            acoruses[r, 3] = "        "+(string)p.Value;

                        if (p.Name == "f_name")
                            acoruses[r, 4] ="  "+(string)p.Value;
                    }
                    r++;
                }
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, acoruses);
                grid_Course.Adapter = adapter;
                return;
            });
        }

        void courses()
        {
            try
            {
                
                WebClient client2 = new WebClient();
                Uri url = new Uri("http://n00ne.xyz/xamarin_facultycoursesR.php");
                NameValueCollection parameters = new NameValueCollection();
                client2.UploadValuesCompleted += Client2_UploadValuesCompleted;
                client2.UploadValuesTaskAsync(url, parameters);
            }
            catch { }

        }

        private void Client2_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            combocourses = new ArrayList();
            RunOnUiThread(() =>
            {
                string json;
                try
                {
                     json = Encoding.UTF8.GetString(e.Result);
                }
                catch { return; }
                JArray a = JArray.Parse(json);
                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        string value = (string)p.Value;
                        combocourses.Add(value);
                    }
                }
                var autoCompleteOptions = combocourses;
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, autoCompleteOptions);
                combo_CourseSearch.Adapter = adapter;
                return;
            });
        }
    }
}