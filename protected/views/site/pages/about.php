<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a "static" page. It is used to show a simple UI.</p>
I need this to be very very long.

<br>
Project 0 - Setting up Minix (10% of project score)

The project is due on Oct. 7, 2011, 23:59:59. You may need 4~20 hours to do this homework.

Project Goals

The goals of this project are:

to install a Minix you can use in future projects
to familiarize yourself with the system
to build and (slightly) modify the Minix kernel
Administrative Information

This is an individual project. Every student must show that he or she is able to install and modify Minix. Also, note that a successful completion of this project is important, since it lays the foundation for the remaining projects.

Step 1: Install the system

It is strongly recommended that you use a VMware Product for your machine as appropriate. Although you may try other VM or PC simulator such as Bochs, Qemu, Parallels, Virtual Box, etc.

We provided a VMWare snapshot that you can work on. However, you are encouraged trying to install Minix from scratch, i.e., obtain an image to install Minix from the Minix download page. For this course, we will use version 3.1.7. For installation instructions, see this page.

Install VMware and Minix:

Download VMware for free. Win/Linux=VMware player. (free version); Mac=VMwareFusion. (select "Get Free Trial" for now)
Install VMware
Download the Minix 3.1.7 VMware image.
Unzip it. You will get a folder "minix", containing several files, including a .vmx file.
Start VMware.
Select "Open" (Mac=bottom menu bar, Win/Linux=Commands section in window).
Browse to the minix folder you just unzipped and select the .vmx file.
Select "Do Not" upgrade.
Select "I copied it".
Minix should now attempt to boot.
Login as root, no password.
You will now have access to several virtual terminals of your Minix OS, use (Mac=fn+option+F1/F2/F3) or (Win/Linux=Alt+F1/F2/F3) to see them.
To logout, type exit or "Cntl+D".
Quit/Shutdown Minix:

Must be logged in as root: type shutdown.
To reboot, type boot at prompt.
To continue shutdown, type off at prompt. Or you can now suspend this VM, or close and exit if desired: (Win/Linux=WMwarePlayer->Troubleshoot->PowerOff and Exit) (Mac=VirtualMachine->PowerOff).
To start again: Run VMware, click on your Minix virtual machine.
If that does not work, restart Minix:(Win/Linux=VMwarePlayer->Troubleshoot->reset) (Mac=VirtualMachine->Reset or ->PowerOn).
Use ftp to easily transfer files to/from Minix and your host OS:

Start from Minix:
Logged in as root, you can now add a user with adduser command. Set password with passwd command.
Exit minix as root; exit
Login as your new user.
You should be at your new user's home directory: pwd
Make a directory for your work: mkdir proj1
Create a sample file in there called 'test_on_minix.txt', using some text editor ('vi' or 'mined' (use ctrl+x to exit mined))
Get Minix's IP address: ifconfig, this will be your current minix_ip_address
Still logged in as root, set up telnet and ftp to run in the background on Minix so you can connect to it. Or manually start ftp server at Minix: tcpd ftp /usr/bin/in.ftpd
Make sure you are connected to the outside world: ping www.sjtu.edu.cn
Problems?
Try: Setting VMware to use NAT rather than bridged, and restart Minix (see instructions above for shutdown). (Mac=VirtualMachine->NetworkAdapter->NAT; Win/Linux= Devices->NetworkAdapter->NAT) This seems to solve most problems.
Try: Setting your home router to use DHCP, and restart Minix (see instructions above for shutdown).
Now, from your host machine
Open a terminal window and cd to your class work directory.
Create a sample file in there called 'test_on_host.txt', using some text editor.
Connect to Minix via ftp: ftp minix_ip_address
Login as the user and password you just created.
Check your location, you should be at the user's home dir. In your ftp window, type pwd. Now cd to your work directory: cd proj1.
Use ftp to move your files around. Use the commands get and put (or mget mput for multiple files) to push and pull your files. Try it:
get test_on_minix.txt
put test_on_host.txt
Check both places and verify the files have been transferred.
Type quit to exit ftp and disconnect from Minix.
Step 2: Configure the system

Once you have installed Minix, there are a few things that you want to do to make the system more usable. The first is to get the network to work. The way how networking is set up depends on your target platform. For Qemu, you will probably want to use the user mode stack. The user mode stack does not require root privileges and should run basically out of the box.

Once the network is active, you might want to install a few other applications to make your life easier. For example, you might want an editor (such as vim), openssh/ncftp (to exchange files between Minix and the outside world), or a new shell (such as bash). Also, check out the source code of Minix that is located in /usr/src and get a feeling for which parts of the OS are located under which directories. Note that openssh is already installed in the provided VMWare image, so you can readily ssh into Minix.

Once you have played around a little bit and have become more familiar with Minix, answer the following questions:

Provide a brief description of your installation, including whether on a simulator (and if so, which one) or on what hardware, and if on actual hardware, whether you have a dedicated machine or a machine that multi-boots Minix and other operating systems. Also (whether on real hardware or on a simulator), the size of your disk and the amount of memory available to the OS.
Why does a new installation of Minix come with an existing user called "ast"?
What is the name of the application (utility) that you used to install new software in Minix?
What is the command that you have to issue to rebuild the kernel and install it?
What is the kernel source file that holds the Minix banner string (i.e., "Minix 3.1.X ... Copyright ...") that is shown when Minix boots up?
What is the name of the Minix system call with the number 33 (decimal), and how did you determine this information?
The answers to these questions have to be written in a plain ASCII file called discussion.txt, which you will need to submit as part of this lab (see below for instructions).

Step 3: Modify and rebuild the kernel

At this point, it is time to rebuild the kernel. To this end, switch to the directory /usr/src/tools and invoke make. Check the options to see how a kernel can be rebuilt and installed. A small note: Once you have installed your kernel and restarted Minix, it is important that you select the third option "Start custom kernel" in the start screen. Otherwise, Minix won't run your freshly built kernel.

When you are able to build a new kernel, it is finally time to make a small OS modification (and enter the realm of kernel hacking :-) ). First, however, you have to make a clean copy of the kernel source tree. This is necessary for two reasons. First, when you later make changes that do not work and you want to have a reference that you can look at, the source is already there. Second, and more importantly, you need such a clean reference to create patches (see below). So, just issue a cp -r /usr/src /usr/src.clean, and you are good to continue.

For the kernel modification itself, I want you to print out the name of every file that is being executed by the OS. To this end, you should locate the kernel source file that implements the exec system call. Then, at the right point, you should insert a printf statement that outputs the string "executing" followed by the name of the file that is being executed. That is, when you type "ls" in the shell, you should see the string "executing ls" being printed to the console. This should actually require only a single line to be added, but it provides you with some (very basic) debugging facilities. Once you have done your modification, rebuilt the kernel, install it, and reboot the system. When you were successful, you should now see a series of output statements that show you which programs the operating systems launches.

Tip: take a look at How to add a system call and System call sequence to better understand how system calls are serviced in Minix OS. Once you understand the mechanism, you can easily locate the place to inject code.
nel running. Specifically, we want to see that you invoke certain commands (e.g., "ls", "pwd", and "w") and the kernel is printing the file names for the executables.
