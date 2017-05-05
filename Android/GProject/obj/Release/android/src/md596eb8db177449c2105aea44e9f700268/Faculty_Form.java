package md596eb8db177449c2105aea44e9f700268;


public class Faculty_Form
	extends android.app.Activity
	implements
		mono.android.IGCUserPeer
{
/** @hide */
	public static final String __md_methods;
	static {
		__md_methods = 
			"n_onCreate:(Landroid/os/Bundle;)V:GetOnCreate_Landroid_os_Bundle_Handler\n" +
			"";
		mono.android.Runtime.register ("GProject.Faculty_Form, GProject, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", Faculty_Form.class, __md_methods);
	}


	public Faculty_Form () throws java.lang.Throwable
	{
		super ();
		if (getClass () == Faculty_Form.class)
			mono.android.TypeManager.Activate ("GProject.Faculty_Form, GProject, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "", this, new java.lang.Object[] {  });
	}


	public void onCreate (android.os.Bundle p0)
	{
		n_onCreate (p0);
	}

	private native void n_onCreate (android.os.Bundle p0);

	private java.util.ArrayList refList;
	public void monodroidAddReference (java.lang.Object obj)
	{
		if (refList == null)
			refList = new java.util.ArrayList ();
		refList.add (obj);
	}

	public void monodroidClearReferences ()
	{
		if (refList != null)
			refList.clear ();
	}
}
