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
    [Activity(Label = "Class Based Search", ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]
    class TimeTableClass : Activity
    {
        private GridView gv;
        private ArrayList atcourse, aclassesname;
        private ArrayAdapter adapter;
        private Spinner spinner;
        private string stday, sttime, stduration, stcourse;
        private string[,] ttable;
        protected override void OnCreate(Bundle savedInstanceState)
        {

            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Time_TableClass);
            gv = FindViewById<GridView>(Resource.Id.gridClass);
            spinner = FindViewById<Spinner>(Resource.Id.comboClassNames);
            classes();
            spinner.ItemSelected += Spinner_ItemSelected;
            
        }


        private void Spinner_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            gv.Adapter = null;
            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_class.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("class_no", spinner.SelectedItem.ToString());
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }
        void classes()
        {
            try
            {
                WebClient client2 = new WebClient();
                Uri url = new Uri("http://n00ne.xyz/xamarin_facultyclass.php");
                NameValueCollection parameters = new NameValueCollection();
                parameters.Add("faculty", LoginForm.faculty);
                client2.UploadValuesCompleted += Client2_UploadValuesCompleted;
                client2.UploadValuesTaskAsync(url, parameters);
            }
            catch { }
        }

        private void Client2_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            aclassesname = new ArrayList();
            RunOnUiThread(() =>
            {
                string json = Encoding.UTF8.GetString(e.Result);
                JArray a = JArray.Parse(json);
                foreach (JObject o in a.Children<JObject>())
                {
                    foreach (JProperty p in o.Properties())
                    {
                        string value = (string)p.Value;
                        aclassesname.Add(value);
                    }
                }
                var autoCompleteOptions = aclassesname;
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, autoCompleteOptions);
                spinner.Adapter = adapter;
                return;
            });

        }
        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {

            RunOnUiThread(() =>
            {

                atcourse = new ArrayList();
                ttable = new string[12, 7];
                for (int i = 0; i < 12; i++)
                {
                    for (int j = 0; j < 7; j++)
                        ttable[i, j] = "";
                }
                ttable[0, 0] = "09:00\n10:00";
                ttable[1, 0] = "10:00\n11:00";
                ttable[2, 0] = "11:00\n12:00";
                ttable[3, 0] = "12:00\n13:00";
                ttable[4, 0] = "13:00\n14:00";
                ttable[5, 0] = "14:00\n15:00";
                ttable[6, 0] = "15:00\n16:00";
                ttable[7, 0] = "16:00\n17:00";
                ttable[8, 0] = "17:00\n18:00";
                ttable[9, 0] = "18:00\n19:00";
                ttable[10, 0] = "19:00\n20:00";
                ttable[11, 0] = "20:00\n21:00";
                try
                {
                    string json = Encoding.UTF8.GetString(e.Result);
                    JArray a = JArray.Parse(json);
                    foreach (JObject o in a.Children<JObject>())
                    {
                        foreach (JProperty p in o.Properties())
                        {
                            if (p.Name == "day")
                            {
                                stday = (string)p.Value;
                            }

                            if (p.Name == "time")
                            {
                                sttime = (string)p.Value;
                            }

                            if (p.Name == "duration")
                            {
                                stduration = (string)p.Value;
                            }
                            if (p.Name == "course")
                            {
                                stcourse = (string)p.Value;

                            }
                        }
                        if (stday == "mon")
                        {
                            int time = Convert.ToInt32(sttime);
                            int dur = Convert.ToInt32(stduration);
                            for (int r = 0; r < dur; r++)
                            {
                                ttable[time-1 + r, 1] = (stcourse);
                            }
                        }
                        else if (stday == "tue")
                        {
                            int time = Convert.ToInt32(sttime);
                            int dur = Convert.ToInt32(stduration);
                            for (int r = 0; r < dur; r++)
                            {
                                ttable[time - 1 + r, 2] = (stcourse);

                            }
                        }
                        else if (stday == "wed")
                        {
                            int time = Convert.ToInt32(sttime);
                            int dur = Convert.ToInt32(stduration);
                            for (int r = 0; r < dur; r++)
                            {
                                ttable[time - 1 + r, 3] = (stcourse);

                            }
                        }
                        else if (stday == "thu")
                        {
                            int time = Convert.ToInt32(sttime);
                            int dur = Convert.ToInt32(stduration);
                            for (int r = 0; r < dur; r++)
                            {
                                ttable[time - 1 + r, 4] = (stcourse);

                            }
                        }
                        else if (stday == "fri")
                        {
                            int time = Convert.ToInt32(sttime);
                            int dur = Convert.ToInt32(stduration);
                            for (int r = 0; r < dur; r++)
                            {
                                ttable[time - 1 + r, 5] = (stcourse);

                            }
                        }
                        else if (stday == "sat")
                        {
                            int time = Convert.ToInt32(sttime);
                            int dur = Convert.ToInt32(stduration);
                            for (int r = 0; r < dur; r++)
                            {
                                ttable[time - 1 + r, 6] = (stcourse);
                            }
                        }
                    }
                    adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleListItem1, ttable);
                    gv.Adapter = adapter;
                    return;
                }
                catch (Exception ex) { Toast.MakeText(this, ex.Message, ToastLength.Long).Show(); }

            });
        }
    }
}