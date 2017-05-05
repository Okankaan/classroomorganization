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
    [Activity(Label = "Empty Classes Based Search", ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]

    class TimeTableEmpty : Activity
    {
        private Spinner combo_DaysEmpty, combo_TimesEmpty, combo_DurationEmpty;
        private int ptime;
        private GridView grid_Empty;
        private ArrayAdapter adapter;
        private string stime;
        private ArrayList adays,atimes,adurations;
        private string[,] emptyclasses;
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Time_TableEmpty);

            combo_TimesEmpty = FindViewById<Spinner>(Resource.Id.comboTimesEmpty);
            combo_DaysEmpty = FindViewById<Spinner>(Resource.Id.comboDaysEmpty);
            combo_DurationEmpty = FindViewById<Spinner>(Resource.Id.comboDurationEmpty);
            grid_Empty = FindViewById<GridView>(Resource.Id.gridEmpty);
            combos();
            combo_DurationEmpty.ItemSelected += Combo_DurationEmpty_ItemSelected;
            combo_DaysEmpty.ItemSelected += Combo_DaysEmpty_ItemSelected;
            combo_DurationEmpty.ItemSelected += Combo_DurationEmpty_ItemSelected1;
        }

        private void Combo_DurationEmpty_ItemSelected1(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            grid_Empty.Adapter = null;
            string tday = combo_DaysEmpty.SelectedItem.ToString().Substring(0, 3);
            picktime();

            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_empty.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("day0", tday);
            parameters.Add("duration0", combo_DurationEmpty.SelectedItem.ToString());
            parameters.Add("time0", ptime.ToString());
            parameters.Add("faculty_id", LoginForm.faculty);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }

        private void Combo_DaysEmpty_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            grid_Empty.Adapter = null;
            string tday = combo_DaysEmpty.SelectedItem.ToString().Substring(0, 3);
            picktime();

            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_empty.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("day0", tday);
            parameters.Add("duration0", combo_DurationEmpty.SelectedItem.ToString());
            parameters.Add("time0", ptime.ToString());
            parameters.Add("faculty_id", LoginForm.faculty);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }

        void combos()
        {
            adays = new ArrayList();

            adays.Add("Monday");
            adays.Add("Tuesday");
            adays.Add("Wednesday");
            adays.Add("Thursday");
            adays.Add("Friday");
            adays.Add("Saturday");

            adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, adays);
            combo_DaysEmpty.Adapter = adapter;

            atimes = new ArrayList();

            atimes.Add("09:00-10:00");
            atimes.Add("10:00-11:00");
            atimes.Add("11:00-12:00");
            atimes.Add("12:00-13:00");
            atimes.Add("13:00-14:00");
            atimes.Add("14:00-15:00");
            atimes.Add("15:00-16:00");
            atimes.Add("16:00-17:00");
            atimes.Add("17:00-18:00");
            atimes.Add("18:00-19:00");
            atimes.Add("19:00-20:00");
            atimes.Add("20:00-21:00");


            adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, atimes);
            combo_TimesEmpty.Adapter = adapter;



            adurations = new ArrayList();

            adurations.Add("1");
            adurations.Add("2");
            adurations.Add("3");
            adurations.Add("4");
            adurations.Add("5");
            adurations.Add("6");

            adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, adurations);
            combo_DurationEmpty.Adapter = adapter;
        }
        void picktime()
        {
            stime = combo_TimesEmpty.SelectedItem.ToString();
            if (stime == "09:00-10:00")
                ptime = 1;
            else if (stime == "10:00-11:00")
                ptime = 2;
            else if (stime == "11:00-12:00")
                ptime = 3;
            else if (stime == "12:00-13:00")
                ptime = 4;
            else if (stime == "13:00-14:00")
                ptime = 5;
            else if (stime == "14:00-15:00")
                ptime = 6;
            else if (stime == "15:00-16:00")
                ptime = 7;
            else if (stime == "16:00-17:00")
                ptime = 8;
            else if (stime == "17:00-18:00")
                ptime = 9;
            else if (stime == "18:00-19:00")
                ptime = 10;
            else if (stime == "19:00-20:00")
                ptime = 11;
            else if (stime == "20:00-21:00")
                ptime = 12;

        }
        private void Combo_DurationEmpty_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            grid_Empty.Adapter = null;
            string tday = combo_DaysEmpty.SelectedItem.ToString().Substring(0, 3);
            picktime();

            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_empty.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("day0", tday);
            parameters.Add("duration0", combo_DurationEmpty.SelectedItem.ToString());
            parameters.Add("time0", ptime.ToString());
            parameters.Add("faculty_id", LoginForm.faculty);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }
        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            int j = 0;
            RunOnUiThread(() =>
            {

                string json;
                try
                {
                    json = Encoding.UTF8.GetString(e.Result);
                }
                catch (Exception ex)
                {
                    Toast.MakeText(this, ex.Message, ToastLength.Long).Show();
                    return;
                }
                JArray a = JArray.Parse(json);

                foreach (JObject o in a.Children<JObject>())
                {
                    j++;
                    foreach (JProperty p in o.Properties())
                    {

                    }
                }

                emptyclasses = new string[j, 5];
                for (int i = 0; i < j; i++)
                {
                    for (int k = 0; k < 5; k++)
                        emptyclasses[i, k] = "";
                }

                j = 0;
                foreach (JObject o in a.Children<JObject>())
                {

                    foreach (JProperty p in o.Properties())
                    {
                        if (p.Name == "class_no")
                            emptyclasses[j, 0] = (string)p.Value;

                        else if (p.Name == "cls_name")
                            emptyclasses[j, 1] = (string)p.Value;

                        else if (p.Name == "capacity")
                            emptyclasses[j, 2] =(string)p.Value;
                        
                        else if (p.Name == "B_Name")
                            emptyclasses[j, 3] = (string)p.Value;

                        else if (p.Name == "F_Name")
                            emptyclasses[j, 4] = (string)p.Value;
                    }
                    j++;
                }
                adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleListItem1, emptyclasses);
                grid_Empty.Adapter = adapter;
                return;
            });
        }
    }
}