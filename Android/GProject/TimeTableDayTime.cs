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
    [Activity(Label = "Day & Time Based Search", ConfigurationChanges = Android.Content.PM.ConfigChanges.Orientation | Android.Content.PM.ConfigChanges.ScreenSize)]
    class TimeTableDayTime : Activity
    {
        private GridView grid_DayTime;
        private string[,] aclasses;
        private string[] days,times,tsection,tduration;
        private Spinner combo_Days,combo_Times;
        private ArrayAdapter adapter;
        string stime;
        int ptime,aclasslength;
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.Time_TableDayTime);
            
            combo_Days = FindViewById<Spinner>(Resource.Id.comboDays);
            combo_Times = FindViewById<Spinner>(Resource.Id.comboTimes);
            grid_DayTime = FindViewById<GridView>(Resource.Id.gridDayTime);
            combo_Days.ItemSelected += Combo_Days_ItemSelected;
            combo_Times.ItemSelected += Combo_Times_ItemSelected;
            vdays();
            grid_DayTime.Adapter = null;

        }
        void vdays()
        {
            WebClient clientDays = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_dayCombo.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("facultyid", LoginForm.faculty);
            clientDays.UploadValuesCompleted += clientDays_UploadValuesCompleted; ;
            clientDays.UploadValuesTaskAsync(url, parameters);
        }
        void vtimes()
        {
            string tday = combo_Days.SelectedItem.ToString().Substring(0, 3);

            WebClient clientTimes = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_timeCombo.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("facultyid", LoginForm.faculty);
            parameters.Add("day", tday);
            clientTimes.UploadValuesCompleted += clientTimes_UploadValuesCompleted;
            clientTimes.UploadValuesTaskAsync(url, parameters);
        }
        void gridEkle()
        {
            ArrayList grideklestring;
            grideklestring = new ArrayList();
            int etime;

            grideklestring.Clear();
            for (int i = 0; i < aclasslength; i++)
            {
                etime = Convert.ToInt32(tsection[i].ToString()) + Convert.ToInt32(tduration[i].ToString());
                if (ptime < etime && ptime >= Convert.ToInt32(tsection[i]))
                {
                    for (int j = 0; j < 5; j++)
                        grideklestring.Add(aclasses[i, j]);
                }
            }
            adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleListItem1, grideklestring);
            grid_DayTime.Adapter = adapter;
            
        }
        void picktime()
        {
            
            if (stime == "9:00-10:00")
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
                ptime =9;
            else if (stime == "18:00-19:00")
                ptime = 10;
            else if (stime == "19:00-20:00")
                ptime = 11;
            else if (stime == "20:00-21:00")
                ptime = 12;

        }
        private void clientTimes_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                int r = 0;
                try
                {
                    string json = Encoding.UTF8.GetString(e.Result);
                    JArray a = JArray.Parse(json);
                    foreach (JObject o in a.Children<JObject>())
                    {

                        foreach (JProperty p in o.Properties())
                        {

                        }
                        r++;
                    }
                    times = new string[r];
                    for (int i = 0; i < r; i++)
                        times[i] = "";

                    r = 0;
                    foreach (JObject o in a.Children<JObject>())
                    {
                        foreach (JProperty p in o.Properties())
                        {
                            times[r] = (string)p.Value;
                        }
                        r++;
                    }
                    adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, times);
                    combo_Times.Adapter = adapter;
                    return;
                }
                catch (Exception ex)
                {
                    Toast.MakeText(this, ex.Message, ToastLength.Long).Show();

                }
                
            });
        }
        private void clientDays_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {
            RunOnUiThread(() =>
            {
                int r = 0;
                try
                {
                    string json = Encoding.UTF8.GetString(e.Result);
                    JArray a = JArray.Parse(json);
                    foreach (JObject o in a.Children<JObject>())
                    {

                        foreach (JProperty p in o.Properties())
                        {
                           
                        }
                        r++;
                    }
                    days = new string[r];
                    for (int i = 0; i < r; i++)
                        days[i] = "";

                    r = 0;
                    foreach (JObject o in a.Children<JObject>())
                    {

                        foreach (JProperty p in o.Properties())
                        {
                            days[r] = (string)p.Value;
                        }
                        r++;
                    }
                    adapter = new ArrayAdapter(this, Android.Resource.Layout.SimpleDropDownItem1Line, days);
                    combo_Days.Adapter = adapter;
                    return;
                }
                catch (Exception ex)
                {
                    Toast.MakeText(this,ex.Message, ToastLength.Long).Show();

                }

            });
        }
        private void Combo_Times_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            grid_DayTime.Adapter = null;

            stime = combo_Times.SelectedItem.ToString();
            picktime();
            string tday = combo_Days.SelectedItem.ToString().Substring(0, 3);

            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_daytime.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("day", tday);
            parameters.Add("facultyid", LoginForm.faculty);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }
        private void Client_UploadValuesCompleted(object sender, UploadValuesCompletedEventArgs e)
        {

            RunOnUiThread(() =>
                {
                    int j = 0;
                    try
                    {
                        string json = Encoding.UTF8.GetString(e.Result);
                        JArray a = JArray.Parse(json);

                        foreach (JObject o in a.Children<JObject>())
                        {
                            j++;
                            foreach (JProperty p in o.Properties())
                            {
                                
                            }
                        }

                        aclasses = new string[j, 5];
                        tsection = new string[j];
                        tduration = new string[j];
                        for (int i = 0; i < j; i++)
                        {
                            tsection[i] = "";
                            tduration[i] = "";
                            for (int k = 0; k < 5; k++)
                                aclasses[i, k] = "";
                        }                            

                        j = 0;
                        aclasslength = 0;
                        foreach (JObject o in a.Children<JObject>())
                        {

                            foreach (JProperty p in o.Properties())
                            {
                                if (p.Name == "cls_name")
                                    aclasses[j, 0] = (string)p.Value;

                                else if (p.Name == "time_section")
                                    tsection[j] = (string)p.Value;

                                else if (p.Name == "ts_duration")
                                    aclasses[j, 1] = (string)p.Value;

                                else if (p.Name == "duration")
                                {
                                    aclasses[j, 2] = "       " + (string)p.Value;
                                    tduration[j] = (string)p.Value;
                                }

                                else if (p.Name == "course")
                                    aclasses[j, 3] = (string)p.Value;

                                else if (p.Name == "f_name")
                                    aclasses[j, 4] = (string)p.Value;
                            }
                            j++;
                        }
                        aclasslength = j;
                        gridEkle();
                    }
                    catch (Exception ex)
                    {
                        Toast.MakeText(this, ex.Message, ToastLength.Long).Show();
                    }
                    return;
                });
        }
        private void Combo_Days_ItemSelected(object sender, AdapterView.ItemSelectedEventArgs e)
        {
            vtimes();
            grid_DayTime.Adapter = null;
            picktime();
            string tday = combo_Days.SelectedItem.ToString().Substring(0, 3);

            WebClient client = new WebClient();
            Uri url = new Uri("http://n00ne.xyz/xamarin_daytime.php");
            NameValueCollection parameters = new NameValueCollection();
            parameters.Add("day", tday);
            parameters.Add("facultyid", LoginForm.faculty);
            client.UploadValuesCompleted += Client_UploadValuesCompleted;
            client.UploadValuesTaskAsync(url, parameters);
        }

    }
}