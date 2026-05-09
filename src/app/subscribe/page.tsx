'use client'

import { useState } from 'react'
import Link from 'next/link'
import Image from 'next/image'
import { CheckIcon, XMarkIcon } from '@heroicons/react/24/outline'
import Header from '@/components/Header'
import Footer from '@/components/Footer'

interface PlanFeature {
  name: string
  included: boolean
}

interface SubscriptionPlan {
  id: string
  name: string
  price: string
  description: string
  features: PlanFeature[]
  popular?: boolean
}

const subscriptionPlans: SubscriptionPlan[] = [
  {
    id: 'free',
    name: 'Free Newsletter',
    price: 'Free',
    description: 'Get our weekly digest of Philadelphia stories',
    features: [
      { name: 'Weekly newsletter', included: true },
      { name: 'Breaking news alerts', included: true },
      { name: 'Event notifications', included: true },
      { name: 'Digital magazine access', included: false },
      { name: 'Premium articles', included: false },
      { name: 'Community forums', included: false },
      { name: 'Print magazine', included: false },
    ],
  },
  {
    id: 'digital',
    name: 'Digital Subscriber',
    price: '$9.99/month',
    description: 'Full digital access to all our content',
    features: [
      { name: 'Weekly newsletter', included: true },
      { name: 'Breaking news alerts', included: true },
      { name: 'Event notifications', included: true },
      { name: 'Digital magazine access', included: true },
      { name: 'Premium articles', included: true },
      { name: 'Community forums', included: true },
      { name: 'Print magazine', included: false },
    ],
    popular: true,
  },
  {
    id: 'premium',
    name: 'Premium Subscriber',
    price: '$19.99/month',
    description: 'Everything digital plus print magazine',
    features: [
      { name: 'Weekly newsletter', included: true },
      { name: 'Breaking news alerts', included: true },
      { name: 'Event notifications', included: true },
      { name: 'Digital magazine access', included: true },
      { name: 'Premium articles', included: true },
      { name: 'Community forums', included: true },
      { name: 'Print magazine', included: true },
    ],
  },
]

export default function SubscribePage() {
  const [selectedPlan, setSelectedPlan] = useState<string>('digital')
  const [email, setEmail] = useState('')
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [isSubmitted, setIsSubmitted] = useState(false)

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setIsSubmitting(true)
    
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 2000))
    
    setIsSubmitting(false)
    setIsSubmitted(true)
  }

  if (isSubmitted) {
    return (
      <div className="min-h-screen bg-white">
        <Header />
        
        <main>
          <section className="py-24 bg-background-light">
            <div className="container-magazine">
              <div className="max-w-2xl mx-auto text-center">
                <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                  <CheckIcon className="w-8 h-8 text-green-600" />
                </div>
                
                <h1 className="text-3xl md:text-4xl font-serif font-bold mb-6">
                  Welcome to the Community!
                </h1>
                
                <p className="text-lg text-text-light mb-8">
                  Thank you for subscribing to Philadelphia RowHome Magazine. 
                  You'll receive your first newsletter within the next few days.
                </p>
                
                <div className="bg-white p-6 rounded-lg border border-gray-200 mb-8">
                  <h3 className="font-serif font-bold mb-4">What's Next?</h3>
                  <ul className="text-left space-y-2 text-text-light">
                    <li>• Check your email for a confirmation message</li>
                    <li>• Follow us on social media for daily updates</li>
                    <li>• Explore our latest articles and event listings</li>
                    <li>• Join our community forums (Premium subscribers)</li>
                  </ul>
                </div>
                
                <div className="flex flex-col sm:flex-row gap-4 justify-center">
                  <Link href="/" className="btn-primary">
                    Explore Articles
                  </Link>
                  <Link href="/events" className="btn-secondary">
                    View Events
                  </Link>
                </div>
              </div>
            </div>
          </section>
        </main>
        
        <Footer />
      </div>
    )
  }

  return (
    <div className="min-h-screen bg-white">
      <Header />
      
      <main>
        {/* Hero Section */}
        <section className="py-16 bg-background-light">
          <div className="container-magazine">
            <div className="max-w-4xl mx-auto text-center">
              <h1 className="text-4xl md:text-5xl font-serif font-bold mb-6">
                Join the Philadelphia RowHome Community
              </h1>
              <p className="text-xl text-text-light leading-relaxed mb-8">
                Get exclusive access to local stories, neighborhood insights, 
                and community events that matter most to Philadelphians.
              </p>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div className="text-center">
                  <div className="w-16 h-16 bg-primary-red rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-white font-bold text-xl">10K+</span>
                  </div>
                  <h3 className="font-serif font-bold mb-2">Subscribers</h3>
                  <p className="text-text-light">Local Philadelphians trust us</p>
                </div>
                
                <div className="text-center">
                  <div className="w-16 h-16 bg-primary-red rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-white font-bold text-xl">50+</span>
                  </div>
                  <h3 className="font-serif font-bold mb-2">Stories Monthly</h3>
                  <p className="text-text-light">Fresh content every week</p>
                </div>
                
                <div className="text-center">
                  <div className="w-16 h-16 bg-primary-red rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-white font-bold text-xl">15+</span>
                  </div>
                  <h3 className="font-serif font-bold mb-2">Neighborhoods</h3>
                  <p className="text-text-light">Coverage across the city</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Subscription Plans */}
        <section className="py-16">
          <div className="container-magazine">
            <div className="max-w-6xl mx-auto">
              <h2 className="text-3xl font-serif font-bold text-center mb-12">
                Choose Your Subscription
              </h2>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                {subscriptionPlans.map((plan) => (
                  <div
                    key={plan.id}
                    className={`relative bg-white border-2 rounded-lg p-8 ${
                      plan.popular
                        ? 'border-primary-red shadow-lg scale-105'
                        : 'border-gray-200 hover:border-gray-300'
                    } transition-all cursor-pointer`}
                    onClick={() => setSelectedPlan(plan.id)}
                  >
                    {plan.popular && (
                      <div className="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span className="bg-primary-red text-white px-4 py-1 text-sm font-medium rounded-full">
                          Most Popular
                        </span>
                      </div>
                    )}
                    
                    <div className="text-center mb-6">
                      <h3 className="text-xl font-serif font-bold mb-2">{plan.name}</h3>
                      <div className="text-3xl font-bold text-primary-red mb-2">{plan.price}</div>
                      <p className="text-text-light">{plan.description}</p>
                    </div>
                    
                    <ul className="space-y-3 mb-8">
                      {plan.features.map((feature, index) => (
                        <li key={index} className="flex items-center">
                          {feature.included ? (
                            <CheckIcon className="w-5 h-5 text-green-500 mr-3 flex-shrink-0" />
                          ) : (
                            <XMarkIcon className="w-5 h-5 text-gray-300 mr-3 flex-shrink-0" />
                          )}
                          <span className={feature.included ? 'text-text-dark' : 'text-text-muted'}>
                            {feature.name}
                          </span>
                        </li>
                      ))}
                    </ul>
                    
                    <button
                      type="button"
                      className={`w-full py-3 px-4 rounded font-medium transition-colors ${
                        selectedPlan === plan.id
                          ? 'bg-primary-red text-white'
                          : 'bg-gray-100 text-text-dark hover:bg-gray-200'
                      }`}
                    >
                      {selectedPlan === plan.id ? 'Selected' : 'Select Plan'}
                    </button>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>

        {/* Signup Form */}
        <section className="py-16 bg-background-light">
          <div className="container-magazine">
            <div className="max-w-md mx-auto">
              <h2 className="text-2xl font-serif font-bold text-center mb-8">
                Complete Your Subscription
              </h2>
              
              <form onSubmit={handleSubmit} className="space-y-6">
                <div>
                  <label htmlFor="email" className="block text-sm font-medium text-text-dark mb-2">
                    Email Address
                  </label>
                  <input
                    type="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    className="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-red"
                    placeholder="Enter your email address"
                    required
                  />
                </div>
                
                <div>
                  <label htmlFor="plan" className="block text-sm font-medium text-text-dark mb-2">
                    Selected Plan
                  </label>
                  <select
                    id="plan"
                    value={selectedPlan}
                    onChange={(e) => setSelectedPlan(e.target.value)}
                    className="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-red"
                  >
                    {subscriptionPlans.map((plan) => (
                      <option key={plan.id} value={plan.id}>
                        {plan.name} - {plan.price}
                      </option>
                    ))}
                  </select>
                </div>
                
                <div className="flex items-start">
                  <input
                    type="checkbox"
                    id="terms"
                    className="mt-1 mr-3"
                    required
                  />
                  <label htmlFor="terms" className="text-sm text-text-light">
                    I agree to the{' '}
                    <Link href="/terms" className="text-primary-red hover:text-red-700">
                      Terms of Service
                    </Link>{' '}
                    and{' '}
                    <Link href="/privacy" className="text-primary-red hover:text-red-700">
                      Privacy Policy
                    </Link>
                  </label>
                </div>
                
                <button
                  type="submit"
                  disabled={isSubmitting}
                  className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  {isSubmitting ? 'Processing...' : 'Subscribe Now'}
                </button>
              </form>
              
              <p className="text-center text-sm text-text-muted mt-6">
                You can cancel your subscription at any time. No long-term commitments.
              </p>
            </div>
          </div>
        </section>

        {/* Testimonials */}
        <section className="py-16">
          <div className="container-magazine">
            <h2 className="text-3xl font-serif font-bold text-center mb-12">
              What Our Subscribers Say
            </h2>
            
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
              <div className="bg-white p-6 rounded-lg border border-gray-200">
                <p className="text-text-light mb-4 italic">
                  "The best way to stay connected with what's happening in Philadelphia. 
                  I love the neighborhood focus and local business spotlights."
                </p>
                <div className="flex items-center">
                  <Image
                    src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=50&h=50&fit=crop&crop=face"
                    alt="Sarah M."
                    width={40}
                    height={40}
                    className="rounded-full mr-3"
                  />
                  <div>
                    <div className="font-medium">Sarah M.</div>
                    <div className="text-sm text-text-muted">Northern Liberties</div>
                  </div>
                </div>
              </div>
              
              <div className="bg-white p-6 rounded-lg border border-gray-200">
                <p className="text-text-light mb-4 italic">
                  "As a real estate professional, I rely on RowHome for market insights 
                  and neighborhood trends. Invaluable resource!"
                </p>
                <div className="flex items-center">
                  <Image
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=50&h=50&fit=crop&crop=face"
                    alt="Mike R."
                    width={40}
                    height={40}
                    className="rounded-full mr-3"
                  />
                  <div>
                    <div className="font-medium">Mike R.</div>
                    <div className="text-sm text-text-muted">Fishtown</div>
                  </div>
                </div>
              </div>
              
              <div className="bg-white p-6 rounded-lg border border-gray-200">
                <p className="text-text-light mb-4 italic">
                  "The food coverage is fantastic! I've discovered so many great 
                  restaurants through their recommendations."
                </p>
                <div className="flex items-center">
                  <Image
                    src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=50&h=50&fit=crop&crop=face"
                    alt="Elena L."
                    width={40}
                    height={40}
                    className="rounded-full mr-3"
                  />
                  <div>
                    <div className="font-medium">Elena L.</div>
                    <div className="text-sm text-text-muted">Rittenhouse Square</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
      
      <Footer />
    </div>
  )
}
