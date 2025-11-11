interface AdPlaceholderProps {
  position: string
  size: '300x250' | '728x90' | '320x50' | '300x600' | 'responsive'
  style?: 'native' | 'banner'
  className?: string
}

export default function AdPlaceholder({ 
  position, 
  size, 
  style = 'banner',
  className = '' 
}: AdPlaceholderProps) {
  // Calculate dimensions based on size
  const getDimensions = () => {
    switch (size) {
      case '300x250':
        return { width: 300, height: 250 }
      case '728x90':
        return { width: 728, height: 90 }
      case '320x50':
        return { width: 320, height: 50 }
      case '300x600':
        return { width: 300, height: 600 }
      case 'responsive':
        return { width: '100%', height: 'auto' }
      default:
        return { width: 300, height: 250 }
    }
  }

  const dimensions = getDimensions()
  const isNative = style === 'native'

  const isResponsive = size === 'responsive'
  
  return (
    <div className={`ad-container ${isNative ? 'ad-native' : 'ad-banner'} ${className}`}>
      <div 
        className={`ad-placeholder ${isResponsive ? 'w-full' : ''}`}
        style={{
          width: dimensions.width === '100%' ? '100%' : `${dimensions.width}px`,
          height: dimensions.height === 'auto' ? 'auto' : `${dimensions.height}px`,
          minHeight: dimensions.height === 'auto' ? '250px' : undefined,
          maxWidth: isResponsive ? '100%' : dimensions.width === '100%' ? '100%' : `${dimensions.width}px`,
        }}
      >
        <div className="ad-label">Advertisement</div>
        <div className="ad-content">
          <div className="ad-size-badge">{size}</div>
          <div className="ad-position-badge">{position}</div>
        </div>
      </div>
    </div>
  )
}

