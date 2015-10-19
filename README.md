# On-The-Job Project for Formstack
## by Kerri Couillard kerri@santafewebprogramming.com 505-231-8370

### On-The-Job Project URL: *http://fampad.com*
### Public GitHub Repo: *https://github.com/kcouillard/formstack*

## My First Attempt ...
Initially, I had considered that I was Formstack’s customer or the company I am currently working for would be Formstack's customer.
I am a web developer for a company who is using more than one API since they specialize in BOTH long-term and short-term/vacation rentals.
They want a totally custom website since the very basic portal/template that both of the API owners provide doesn't include the other, and visa-versa.
I wanted to do a Formstack and Escapia API mashup. The company that I am working with uses Google Analytics heavily,
but they aren’t getting any data specifically from any of their form fields or submits.

I had planned to have a series of Formstack Escapia forms that tracked and gained insights from their form fields and submits:
1. Advanced Search Form (calls out to Escapia software via API to get properties that match the inputs)
  - tell them what their customers want exactly
  - what are the most valuable amenities/dates for arrival and departure
2. Inquire Form (sends an inquiry about a property into the Escapia software via API)
  - what are the most popular houses
  - compare to this to online booking form, some still want to inquire and book over phone
3. Get Quote Form (requests price for a property based on inputs to the Escapia software via API)
  - who gets quote and doesn't book
4. Make Reservation Form (books a property based on inputs in the Escapia software via API)

And so on, lots of new form data to collect here.

I successfully implemented the advance search form as a test to try and see what field analysis was happening or available from within Formstack.
*http://kokopellipropertiessantefe.com/vrentals/formstack*

I was hoping to gain the insight as to what most people were searching for, in order to present back to the company, the most popular search parameters.
This information could help them determine exactly how to grow their inventory best for their customers.

## Final Project - Mashup for Address Validation and Match ...
I realized that Formstack doesn’t do much field analysis right now and I came to a new conclusion. I think the most interesting position for me at Formstack
would be that of *Software Developer - Attribution and Analytics*, rather than what I initially applied for, being Form Conversions.

Next, I researched the Client page on the Formstack website, watched the University video, and put myself in the shoes of what seems to be the intended
customer for Formstack.  I also looked at all of the provided examples to get a better idea of how Formstack is used and in what industries.
I considered the idea of a simple contact form and what could enhance it by using 1 other API as a smart and useful mashup.
I decided to implement Address validation and matching.

I signed up for a 30 day free trial with Service Objects in order to do Address validation and matching on the address form.
- https://www.serviceobjects.com/solutions
- Username: kerri@santafewebprogramming.com
- Password: mghB7xDd
- API Trial Key: WS72-SHR1-FOT4

## Work Description:
- In-depth R&D on Formstack
- Integrated Formstack with Escapia UnitSearch methods http://kokopellipropertiessantefe.com/vrentals/formstack
- Form built in Formstack with hidden field
- Formstack wrapper for api used to submit fields to formstack
- Form validation and error handling/exception handling
- New class for Service Object for address validation and matching
- Form programming to prepare fields for both APIs
- Simple hand-coded application sans a big framework used
- Twitter bootstrap implemented
- Bootstrap overrides in CSS
- Readme markdown
- Git


