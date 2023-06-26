
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   
</head>
<body>
    <h1 class="text center bg-primary">Job Offer Letter</h1>
{{-- @dd($info); --}}
<div>
<span>To</span>

<p id="date">Date: {{ date('d-m-Y') }}</p>
<div class="float-left">
<p>Employee Name :- {{ $name }}</p>
<p>Company Name :- Mahesh suppliers (india) Pvt. Ltd.</p>
<p>Address :- {{ $address }}</p>
</div>


<span class="mt-3">Dear {{ $name }}</span>

<p>Mahesh Suppliers (India) Pvt. Ltd. is pleased to offer you a position of {{ $role }} further to interview and discussions you had 
with us on following terms and conditions. As a member of our team your annual CTC will be {{ $offer_salary*12 }} the detailed appointment letter will 
be issued to you at the end of your probation period.</p>

<p>Date of Joining :- {{ $date_of_joining }}</p>
<ol>
<li>
Please note the offer will be withdrawn, in case you do not notify and delay in joining or we are unable to agree to an alternate joining date. Your appointment will totally subject to the reference check.
</li>
<li class="mt-1">
Probation Period :- You would be on probation period for six ( 6 ) months, at the end of completion of probation period, management shall reserve a right whether to confirm your appointment or not.
</li>
<li class="mt-2">
Place of Work :- Inside Gogagate Upside Chabilli Ghati, Bikaner
</li>
<li class="mt-2">
Salary Clause:- The Annual Starting Salary for this Position is {{ $offer_salary }} to be Paid on Monthly Basis. First Year:- {{ $offer_salary }}-2500 = {{ $offer_salary-2500 }} per Month Difference of amount that is 30,000 rs will be paid 
                 to you after successfully completing 1 year and then onwards your in hand salary will be rs {{ $offer_salary+2500 }} per month.After successful completion of the one year and review thereof, 
                you will be entitled to other benefits of increment as per policies of the organization.
</li>
<li class="mt-2">
Rules & Regulations :- You will be subjected to the rules and regulations of the company, as many be in force from time to time and place to place.
</li>
<li class="mt-2">
Notice Period :- If at any point of time, you wish to leave our company, you shall serve a notice period of 60 days on mandatory basis, your notice period would start to count from the day submit your letter of resignation to our HR and if not able to pursue then you will asked to wave off your last month salary, your early leave from our company will only be acceptable under desirable conditions where you need to provide an approval from the directors itself.
</li>
</ol>





{{-- ---- --}}
<h3>General Rules and Regulations</h3>

<p class="mt-5">Dear {{ $name }}</p>


<p class="mt-3">Every office has its set of rules and regulations they basically outline the philosophy of the management and are necessary because they help the organization in removing any ambiguity on its or the employeeâs part on what is acceptance and what is not.</p>
<p>Please go through these pages and give your acceptance to these at the end.</p>
<ol>
    <li>Your official hours of work will be notified to you as and when required by the management.</li>
    <li>The office hours are 09:00 AM (SHARP) to 05:00 PM.</li>
    <li>The company will expect you to assist with completion of work, and the working hours may be varied to achieve this. Any such additional work will be considered during your ongoing reviews and demonstrates your commitment to your career and the company.</li>
    <li>In case you would be late (more than 15mins.) you need to inform the manager HR and your team lead about it.</li>
    <li>Lunch break slot: - 30 minutes (as to now from 13:00 HRS to 13:30 HRS)</li>
    <li>The management of the company may amend or alter your position and/ or job function in order to best suit the needs to the company as well as your ongoing development and capabilities.
        Office Decorum:</li>
    <li>You must abide by the Rules & Regulations of the company applicable at all times, and these may be changed at any time and the same will be notified to you by the management.</li>
    <li>Office attire: Wear clothes that are presentable and professional.</li>
    <li>Maintain proper office decorum, and do not waste your time your motto for the day should be when I am over with the day, I should have achieved something, and also do not get in to the habit of the postponing / delaying things, finish your days work before you head to home.</li>
    <li>Please take care of office equipment and other stuff the work station allocated to you is your responsibility, maintain it properly and prove a point to others, everyone likes to look at things that are beautiful-including a beautifully maintained work area.</li>
    <li>We at Mahesh Suppliers (India) Pvt. Ltd. believe that each and every employee is a MATURE AND RESPONSIBLE ADULT, who knows what is proper and what is not, we also strongly believe in the concept of Z theory, but would also expect certain of professional behavior from your end â do not indulge in any activity / action which would let us believe on the contrary.</li>
    <li>In keeping with the above point we have provided each of the work stations with broadband internet connection, because we believe that there should not be any differentiation on any basis but these this added responsibility that we have provided to you also entitles you to use it properly and appropriately, do not misuse it. Use of internet for job searches and download of adult or inappropriate content is strictly prohibited â and the management will view this is a serious misconduct and reserves the right to take disciplinary action as per point number.</li>
    <li>Also limit the amount of time (and calls) that you would have personal telephone calls during office hours ideally you should try to avoid any personal calls, until and unless it is very urgent and important.
        Work Ethics:</li>
<li>
We at Mahesh Suppliers (India) Pvt. Ltd. Follow and implement the equal opportunity concept â which means that the only way to success here is by following professionalism, we do not follow and appreciate that are based on cast, gender creed or any other factor other that professionalism; result are a part of Mahesh Suppliers (India) Pvt. Ltd. Philosophy and are also appreciated and acknowledged.
</li>
<li>
We also encouraged the concept of in- house training, skill set up gradation and moving up the staff to the next level, rather than hire people from outside the organization whenever possible.
</li>
<li>
The company will provide the ongoing training programs that best suit the company requirements and your ongoing career development. These training sessions may be held outside of the office hours.
Disclosure Clause:
</li>
<li>

The management resolves the right to take disciplinary action, including termination of an employee, if the information furnished by the employee at the time of hiring and or during the job; turns out to be false/ fabricated.
</li>
<li>
You should not disclose or share with anyone by word of mouth or any other means, any particular(s) or details of company processes, technical information, security arrangement, systems, procedures or any other company confidential information acquired during the course of your employment, for the duration of your employment thereafter.
</li>
<li>
The services / products / program created by the employees are the sole property of the company or its clients and the employee has no right whatsoever.
</li>
<li>
During the period of your employment you shall not take any other employment, assignment or contracts without the prior written permission any authorization of the management.
Leave Rules and Encashment:
</li>
<li>
Your yearly leave and holidays entitlement is:
<ul>
<li>All Sundays</li>
<li>Cultural holidays company will keep informing you time to time</li>
<li>40 leaves applicable for each year after the probation period of 6 months.</li>
</ul>
</li>
<li>
Every employee need to give an application for leave through an e-mail at 4 days (96 Hrs) in advance to the date he / she intends to avail as leave days.
</li>
<li>
The leaves are sanctioned by the team lead.
</li>
<li>
In cause of an unplanned leave-please inform your team lead or HR.
</li>
<li>
Additional leaves cannot be clubbed together with public holidays.
</li>
<li>
In case of medical leave one needs to finish the relevant supporting documents (a medical certificate from a certified doctor).
</li>
<li>
Leave for more than 2 days continuously in a month will be sanctioned only on a case basis by the management.
</li>
<li>
In case where an employee takes more than sanctioned leaves, the management reserves the right to take disciplinary action, including deduction of salary and / or termination of service.
</li>
<li>
Leave without information / approval for more than two days would also warrant disciplinary action, as deemed fit by the management.
</li>
<li>
In case of absence due to illness, you must notify the management no letter than midday of the day of absence, if you are found to be suffering any infectious disease or a protracted illness that was not disclosed to the company at the time of your appointment, the company shall reserve the right to terminate your employment contract.
Confirmation and Appraisal of Employees:
</li>
<li>
Unless stated otherwise (on the offer / appointment letter), every employee is on probation for a period of first six month (06) from his / her date of joining.
</li>
<li>
We have regular appraisals for each and everyone knows where one stands in the organization vis-Ã -vis his peers and also that he has a clear idea about his career path.
</li>
<li>
The management can extend the probation period.
</li>
<li>
During the training period of 6 months, the company can extend the training or terminate the services due to poor performance without giving any clear notice of one month.
</li>
<li>
If at any time during your period of employment you are found guilty of misconduct, willful negligence, disobedience, misappropriation, insubordination or breach of any terms as outlined above and / or the terms and conditions of your employment, the company will terminate your appointment without any notice or pay of lieu thereof.
</li>

</ol>
<p>
    We hope these rules and regulations meet with your approval, and request you to sing both copies with your acceptance and return one copy to the office at your earliest.
    </p>
    
    <b>
    HR Manager <br>
    Mahesh Suppliers (India) Pvt. Ltd.
    </b>
</div>
</body>
</html>

